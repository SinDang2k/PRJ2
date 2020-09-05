<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\Admin;
use App\Models\ForgotPassword as ModelsForgotPassword;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPassword extends Controller
{
    public function check_exist_email_admin(Request $request)
    {
        return Admin::whereEmail($request->email)->get();
    }

    public function send_email_forgot_password(Request $request)
    {
        $admin=Admin::whereEmail($request->email)->get();
        $token=random_bytes(20);
        $token=bin2hex($token);
        $time_out=strtotime("+1 day");
        $time_out=date('Y-m-d H:i:s',$time_out);
        $check=ModelsForgotPassword::where(['id_person'=>$admin[0]->id,'position'=>1])
        ->get();
        if(count($check)==0)
        {
            ModelsForgotPassword::insert([
                'id_person'=>$admin[0]->id,
                'position'=>1,
                'token'=>$token,
                'timeout'=>$time_out,
                'limitt'=>1,
                'status'=>0,
            ]);
            $position=1;
            Mail::to($request->email)
            ->send(new MailForgotPassword($admin[0]->full_name,$token,$time_out,$position));

            return redirect()->route('mail.success');
        }
        elseif($check[0]->limitt<3){
            ModelsForgotPassword::where(['id_person'=>$admin[0]->id,'position'=>1])
            ->update([
                'token'=>$token,
                'timeout'=>$time_out,
                'status'=>0,
                'limitt'=>$check[0]->limitt+1,
            ]);
            $position=1;
            Mail::to($request->email)
            ->send(new MailForgotPassword($admin[0]->full_name,$token,$time_out,$position));

            return redirect()->route('mail.success');
        }
        else{
            return view('mail.success',['that_bai'=>1]);
        }
    }

    public function change_password($token)
    {
        $now=date('Y-m-d H:i:s');
        $token=ModelsForgotPassword::where('token', $token)
        ->where('position',1)
        ->whereRaw("TIMESTAMPDIFF(SECOND,timeout,'$now')<0 and status=0")
        ->get();

        if(count($token)==0)
        {
            return  view('mail.success',['that_bai'=>1,'token_loi'=>1,'position'=>1]);
        }
        else{
            return view('admin.reset_password',['token'=>$token]);
        }
    }

    public function process_change_password($token,Request $request)
    {
        $token=ModelsForgotPassword::where(['token'=>$token,'position'=>1])
        ->orderBy('timeout','desc')
        ->take(1)
        ->get();

        ModelsForgotPassword::find($token[0]->id)->update(['status'=>1]);

        Admin::find($token[0]->id_person)
        ->update(['password'=>bcrypt($request->password)]);
        return redirect()->route('admin.getLogin');
    }


//Teacher


    public function send_email_forgot_password_teacher(Request $request)
    {
        $teacher=Teacher::whereEmail($request->email)->get();
        $token=random_bytes(20);
        $token=bin2hex($token);
        $time_out=strtotime("+1 day");
        $time_out=date('Y-m-d H:i:s',$time_out);
        $position=0;
        $check=ModelsForgotPassword::where(['id_person'=>$teacher[0]->id,'position'=>0])
        ->get();
        if(count($check)==0)
        {
            ModelsForgotPassword::insert([
                'id_person'=>$teacher[0]->id,
                'position'=>$position,
                'token'=>$token,
                'timeout'=>$time_out,
                'limitt'=>1,
                'status'=>0,
            ]);
            Mail::to($request->email)
            ->send(new MailForgotPassword($teacher[0]->full_name,$token,$time_out,$position));

            return redirect()->route('mail.success');
        }
        elseif($check[0]->limitt<3){
            ModelsForgotPassword::where(['id_person'=>$teacher[0]->id,'position'=>0])
            ->update([
                'token'=>$token,
                'timeout'=>$time_out,
                'status'=>0,
                'limitt'=>$check[0]->limitt+1,
            ]);
            Mail::to($request->email)
            ->send(new MailForgotPassword($teacher[0]->full_name,$token,$time_out,$position));

            return redirect()->route('mail.success');
        }
        else{
            return view('mail.success',['that_bai'=>1]);
        }
    }


    public function check_exist_email_teacher(Request $request)
    {
        return Teacher::whereEmail($request->email)->get();
    }

    public function change_password_teacher($token)
    {
        $now=date('Y-m-d H:i:s');
        $token=ModelsForgotPassword::where('token', $token)
        ->where('position',0)
        ->whereRaw("TIMESTAMPDIFF(SECOND,timeout,'$now')<0 and status=0")
        ->get();
        if(count($token)==0)
        {
            return view('mail.success',['that_bai'=>1,'token_loi'=>1,'position'=>0]);
        }
        else{
            return view('teacher.reset_password',['token'=>$token]);
        }
    }

    public function process_change_password_teacher($token,Request $request)
    {
        $token=ModelsForgotPassword::where(['token'=>$token,'position'=>0])
        ->orderBy('timeout','desc')
        ->take(1)
        ->get();

        ModelsForgotPassword::find($token[0]->id)->update(['status'=>1]);

        Teacher::find($token[0]->id_person)
        ->update(['password'=>bcrypt($request->password)]);
        return redirect()->route('teacher.getLogin');
    }
}
