<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Resources\OrganizationResource;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Organization;
use App\Utils\Enums\EnumResponse;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateOrganization (Request $request) {
    	try {
    		$id = 1;
    		$model = Organization::updateOrCreate(
    			['id' => 1],
    			[
    				'name' => $request['name'],
					'currency' => $request['currency'],
					'address' => $request['address'],
					'city' => $request['city'],
					'country' => $request['country'],
					'phone' => $request['phone'],
					'document' => $request['document'],
					'type_document_id' => $request['type_document_id']
    			]
    		);
    		$data = new OrganizationResource($model);
    		return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
    	} catch (Exception $e) {
    		return $e;
    	}
    }

    public function showOrganization () {
    	try {
    		$model = Organization::find(1);
    		if ($model) {
    			$data = new OrganizationResource($model);
    		} else {
    			$data = null;
    		}
	    	return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
    	} catch (Exception $e) {
    		return $e;
    	}
    }

}
