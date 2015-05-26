<?php namespace App\Http\Controllers;

use App\Attendance;
use App\Assignment;
use App\Workplace;
use App\Http\Controllers\Controller;
use App\Worker;
use Illuminate\Http\Request;

class AttendanceController extends Controller{


    public function register($dni,$latitude,$longitude,$type){

        /*$attendance= new Attendance();
        $attendance->day_attendance=date('Y-m-d');
        $attendance->start_work_hour="2:30 pm";
        $attendance->save();

        return $this->showResponse($attendance);*/

        if(!$worker= Worker::where('dni','=',$dni)->first())
        {
            return $this->notFoundResponse();
        }
        //dd($worker);
        $assignment=Assignment::where('worker_id',$worker->id)->first();
        //dd($assignment);
        $attendance=new Attendance();
        $attendance->assignment_id=$assignment->id;
        $attendance->day_attendance=date("Y-m-d H:i:s");
        $attendance->start_work_hour=date("H:i:s");
        $attendance->save();

        return $this->showResponse($attendance);
    }

    public function workers($local_id){

        $local_id=1;
        $workplace=Workplace::find($local_id);
        $assignments=Assignment::with('worker')->where('workplace_id',$workplace->id)->get();

        $wokers=array();
        foreach($assignments as $assignment){
            $wokers[]=$assignment->worker()->first();
        }

        return $this->showResponse($wokers);
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