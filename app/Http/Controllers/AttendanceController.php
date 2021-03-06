<?php namespace App\Http\Controllers;

use App\Attendance;
use App\Assignment;
use App\Workplace;
use App\Http\Controllers\Controller;
use App\Worker;
use Illuminate\Http\Request;

class AttendanceController extends Controller{


    public function register($dni,$latitude,$longitude,$type){

        if(!$worker= Worker::where('dni','=',$dni)->first())
        {
            return $this->notFoundResponse();
        }
        //dd($worker);
        date_default_timezone_set("America/Lima");
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
        $assignments=Assignment::with('worker.attachments','attendance')->where('workplace_id',$workplace->id)->orderBy('type_assignment','desc')->get();

        $wokers=array();
        foreach($assignments as $assignment){
            //$wokers[]=$assignment->worker()->first();
            $shift="";
            $foto="";
            $status=0;

            if($assignment->type_assignment<>1){
                $status=$assignment->type_assignment;
            }

            if($assignment->attendance->count()>0){
                $status=1;
                $shift= $assignment->attendance->first()->start_work_hour." ".$assignment->attendance->first()->end_work_hour." ".
                    $assignment->attendance->first()->start_lunch_hour." ".$assignment->attendance->first()->end_lunch_hour." ";
            }

            foreach($assignment->worker->attachments as $attachment){
                if($attachment->type==2){
                    $foto=$attachment->url;
                }
            }

            $wokers[]=array('full_name' =>$assignment->worker()->first()->first_name.' '.$assignment->worker()->first()->first_last_name.' '.$assignment->worker()->first()->second_last_name,
                'mobile'=>$assignment->worker()->first()->mobile,'job_title'=>$assignment->worker()->first()->job_title,
                'shift'=>$shift,'foto'=>$foto,'status'=>$status,);
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