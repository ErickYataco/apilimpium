<?php namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Person;
use Illuminate\Http\Request;

class AttendanceController extends Controller{


    public function register($dni,$latitude,$longitude,$type){

        /*$attendance= new Attendance();
        $attendance->day_attendance=date('Y-m-d');
        $attendance->start_work_hour="2:30 pm";
        $attendance->save();

        return $this->showResponse($attendance);*/

        if(!$person= Person::where('dni','=',$dni))
        {
            return $this->notFoundResponse();
        }
        $person->status=1;
        $person->save();
    }

    public function workers($local_id){

        return $this->showResponse(Person::all());
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