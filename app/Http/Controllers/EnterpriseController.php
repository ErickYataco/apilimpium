<?php namespace App\Http\Controllers;


use App\Enterprise;


class EnterpriseController extends Controller{


    public function filter($text){

        if(!$enterprise= Enterprise::where('name','LIKE',"%$text%")->get())
        {
            return $this->notFoundResponse();
        }

        return $this->showResponse($enterprise);
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