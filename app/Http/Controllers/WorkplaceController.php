<?php namespace App\Http\Controllers;

use App\Workplace;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkplaceController extends Controller{


	public function filter($idEnterprise,$text){

		if(!$workplaces= Workplace::where('name','LIKE',"%$text%")->where('account_id',$idEnterprise)->get())
		{
			return $this->notFoundResponse();
		}

		return $this->showResponse($workplaces);
	}

    public function register_location($id,$latitude,$longitude){

        if(!$workplace= Workplace::find($id))
        {
            return $this->notFoundResponse();
        }
        $workplace->latitude=$latitude;
        $workplace->longitude=$longitude;
        $workplace->save();

        return $this->showResponse($workplace);
    }

    protected function showResponse($data)
    {
        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function notFoundResponse()
    {
        $response = [
            'code' => 404,
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }

}