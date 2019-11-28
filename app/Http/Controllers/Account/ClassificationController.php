<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\EntityOtherClassification;

class ClassificationController extends Controller
{
	public function store()
	{
		$account 			            = User::findOrFail(session('user_id'));
		$classifications                = request()->classifications;
		$account_other_classifications  = $account->other_classifications;
		$classification_add_data_set    = [];

		EntityOtherClassification::destroy($account_other_classifications->pluck('id'));

		foreach ($classifications as $classification) {
			$classification_add_data_set[] = [
				'entity_type'       => request()->entity_type,
				'entity_id'         => request()->entity_id,
				'classification_id' => $classification,
				'created_at'        => now('Asia/Manila'),
				'updated_at'        => now('Asia/Manila')
			];
		}
		EntityOtherClassification::insert($classification_add_data_set);

		return back();
	}
}