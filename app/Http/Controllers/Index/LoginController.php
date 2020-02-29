<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Member;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function regdo(){
        $post = request()->except('_token');
        $code = session('code');
        if($code!=$post['code']){
            return redirect('/reg')->with('msg','您输入的验证码不对');
        }
        $user = [
         'moblie'=>$post['moblie'],
         'pwd'=>$post['pwd'],
         'add_time'=>time()
        ];
       $res = Login::create($user);
        if($res){
          return redirect('/login');
        }
    }
    public function reg(){
        return view('index.register');
    }
    public function login(){
        return view('index.login');
    }
    public function dologin(){
        $post = request()->except('_token');
       
         $data = Login::where($post)->first();
         
         if($data){
           return redirect('/');
         }else{
             return redirect('/login');
         }
    }
    public function sendemail(){
        
        $email = request()->moblie;;
       $res = Mail::to($email)->send(new SendCode());
       if($res){
        session(['code'=>$code]);
        request()->session()->save();

        echo json_encode(['code'=>'00000','msg'=>'ok']);die;
       }
       echo json_encode(['code'=>'00001','msg'=>'发送邮件失败']);die;

    }
    public function ajaxsend(){
        //接受注册页面的手机号
       // $moblie = '17320674852';
        $moblie = request()->moblie;
    
        $code = rand(1000,9999);
       
        $res = $this->sendSms($moblie,$code);
        
        if( $res['Code']=='OK'){
            session(['code'=>$code]);
            request()->session()->save();

            echo json_encode(['code'=>'00000','msg'=>'ok']);die;
        }
        echo json_encode(['code'=>'00001','msg'=>'发送短信失败']);die;
    }
    
    public function sendSms($moblie,$code){
         
            AlibabaCloud::accessKeyClient('LTAI4FmuXkKRKzC4DprH5cqD', 'KbQoSSrnTzFDQ7XP7is9AsdMgI9nys')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

try {
$result = AlibabaCloud::rpc()
              ->product('Dysmsapi')
              // ->scheme('https') // https | http
              ->version('2017-05-25')
              ->action('SendSms')
              ->method('POST')
              ->host('dysmsapi.aliyuncs.com')
              ->options([
                            'query' => [
                              'RegionId' => "cn-hangzhou",
                              'PhoneNumbers' =>$moblie,
                              'SignName' => "梦想总是遥不可及",
                              'TemplateCode' => "SMS_178755799",
                              'TemplateParam' => "{code:$code}",
                            ],
                        ])
              ->request();
return $result->toArray();
} catch (ClientException $e) {
return $e->getErrorMessage();
} catch (ServerException $e) {
return $e->getErrorMessage();
}

    
}
}
