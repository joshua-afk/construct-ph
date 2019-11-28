<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Company;
use App\EntityClassification;
use App\Job;
use App\JobInvitation;
use App\JobEntry;
use App\JobReview;
use App\JobClassification;
use App\JobQualification;

class JobController extends Controller
{
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function index()
    {
        $jobs               = Job::latest('created_at')->get();
        $user               = User::find(session('user_id'));
        $user_job_bookmarks = $user->job_bookmarks->pluck('bookmark_id')->toArray();
        return view('jobs.index', compact('jobs', 'user_job_bookmarks'));
    }

    public function create()
    {
        $user            = User::findOrFail(session('user_id'));

        $user_companies  = User::where('id', session('user_id'))->first()->companies;
        $classifications = $this->classifications();
        $regions         = $this->regions();
        $cities          = $this->cities();

        return view('jobs.create', compact('user', 'user_companies', 'classifications', 'regions', 'cities'));
    }

    public function show(Job $job)
    {
        if (session('user_type') === 4) {
            $job_entry = JobEntry::where('entity_type', 2)
                                 ->whereIn('entity_id', User::find(session('user_id'))->companies->pluck('id'))
                                 ->first();
        } else {
            $job_entry = JobEntry::where('entity_type', 1)
                                 ->where('entity_id', session('user_id'))
                                 ->first();
        }
        $companies = Company::where('user_id', session('user_id'))->get();

        $job_review = JobReview::where('job_id', $job->id)
                               ->where('from_id', session('user_id'))
                               ->where('role', 'applicant')
                               ->first();

        // return $job->entries;
        return view('jobs.show', compact('job', 'companies', 'job_entry', 'job_review'));
    }

    public function store()
    {
        $validated_attr = request()->validate([
            'entity_id'    => 'required',
            'title'        => 'required',
            'description'  => 'required',
            'region_id'    => 'required',
            'city_id'      => 'required',
            'zip'          => 'required|numeric',
            'salary_min'   => 'required|numeric',
            'salary_max'   => 'required|numeric',
            'hire_count'   => 'required|numeric',
            'deadline'     => 'required',
            'professional' => 'required_without:contractor,supplier',
        ], [
            'entity_id.required'            => 'Company field is required.',
            'region_id.required'            => 'Region field is required',
            'city_id.required'              => 'City field is required',
            'professional.required_without' => 'One of these fields is required.'
        ]);

        $user = User::findOrFail(session('user_id'));
        $uuid = $this->uuid();

        unset($validated_attr['professional']);

        switch ($user->type) {
            // Client
            case 2:
                $entity_type = 3;
                break;
            // Professional
            case 3:
                $entity_type = 1;
                break;
            // Company
            case 4:
                $entity_type = 2;
                break;
        }

        $validated_attr['deadline'] = Carbon::parse(request()->deadline);

        $professional = (request()->has('professional')) ? true : false ;
        $contractor   = (request()->has('contractor')) ? true : false ;
        $supplier     = (request()->has('supplier')) ? true : false ;

        $this->job::create($validated_attr + [
            'code'         => $uuid,
            'entity_type'  => $entity_type,
            'status'       => 'hiring',
            'created_at'   => now('Asia/Manila'),
            'updated_at'   => now('Asia/Manila'),
        ]);

        // Fetch the inserted job
        $job = Job::where('code', $uuid)->select('id')->first();

        // Store JobClassifications
        $this->storeJobClassification($job->id, request()->classifications);

        // Store JobQualifications
        $this->storeJobQualifications($job->id, $professional, $contractor, $supplier);

        // Notify all the companies and professionals that has the same classifications
        $qualified_entities = EntityClassification::whereIn('classification_id', request()->classifications)->get();
        $job_invitations = [];
        foreach ($qualified_entities as $entity) {
            $job_invitations[] = [
                'job_id'      => $job->id,
                'entity_type' => $entity->entity_type,
                'entity_id'   => $entity->entity_id,
                'status'      => 'pending',
                'created_at'  => now('Asia/Manila'),
                'updated_at'  => now('Asia/Manila')
            ];
        }
        JobInvitation::insert($job_invitations);

        return redirect('/jobs');
    }

    protected function storeJobClassification($job_id, $classifications)
    {
        if (!is_null($classifications)) {
            $my_classifications = [];
            foreach ($classifications as $classification) {
                $my_classifications[] = [
                    'job_id'            => $job_id,
                    'classification_id' => $classification,
                    'created_at'        => now('Asia/Manila'),
                    'updated_at'        => now('Asia/Manila'),
                ];
            }
            return JobClassification::insert($my_classifications);
        }
    }

    protected function storeJobQualifications($job_id, $professional, $contractor, $supplier)
    {
        return JobQualification::insert([
            'job_id'       => $job_id,
            'professional' => $professional,
            'contractor'   => $contractor,
            'supplier'     => $supplier,
            'created_at'   => now('Asia/Manila'),
            'updated_at'   => now('Asia/Manila'),
        ]);
    }
}
