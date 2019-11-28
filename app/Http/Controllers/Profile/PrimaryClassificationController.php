<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\EntityClassification;

class PrimaryClassificationController extends Controller
{
	public function __construct(EntityClassification $classification)
	{
		$this->classification = $classification;
	}

    public function store()
    {
    	$validated_attr = request()->validate([
    		'classification_id' => 'required',
    	]);

    	$this->classification->updateOrCreate([
    			'entity_type' => request()->entity_type,
    			'entity_id'   => request()->entity_id,
    		], $validated_attr);

    	return back();
    }
}
