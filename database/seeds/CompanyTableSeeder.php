<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Company;
use Carbon\Carbon;

class CompanyTableSeeder extends Seeder{

	public function uuid(){
		return (string) Str::uuid();
	}

	public function run(){

		include_once('company_attrib/names.php');
		include_once('company_attrib/authorized_managing_officer.php');
		include_once('company_attrib/categories.php');
		include_once('company_attrib/license.php');
		include_once('company_attrib/lat.php');
		include_once('company_attrib/long.php');
		include_once('company_attrib/pcab_license_validity.php');
		include_once('company_attrib/regions.php');
		include_once('company_attrib/type.php');
		include_once('company_attrib/validity_for_government_project.php');

		foreach ($pcab_license as $key => $license) {
			Company::insert([
				'id' 			=> $key + 1,
				'code'			=> $this->uuid(),
				'pcab_license'  => $license,
				'company_name'  => $company_names[$key],
				'category' 		=> $categories[$key],
				'type' 			=> $type[$key],
				'authorized_managing_officer' => $authorized_managing_officer[$key],
				'pcab_license_validity' => $pcab_license_validity[$key],
				'gov_proj_validity'		=> $gov_proj_validity[$key],
				'region_id'		=> $regions[$key],
				'latitude'		=> $latitude[$key],
				'longtitude'	=> $longtitude[$key],
				'created_at' 	=> Carbon::now('Asia/Manila'),
				'updated_at' 	=> Carbon::now('Asia/Manila'),
			]);
		}
	}
}
