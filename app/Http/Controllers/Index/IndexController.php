<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use AlibabaCloud\Client\AlibabaCloud;
use App\Goods;
use App\Brand;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
   function index(){

    
     $data = Goods::leftjoin('brand','goods.b_id','=','brand.b_id')->get();
  
    return view('index.index',['data'=>$data]);
   }
   function product(){
    $id = request()->id;
      $data = Redis::incr('num_'.$id);
      var_dump($data);
      if(!$data){
        Redis::setnx('num_'.$id,0);
      }
       return view('index.product');
   }
   function setcookie(){
       //第一种
     //  return response('测试产生cookie')->cookie('name','tianzijian',6);
      
        //第二中cookie全局辅助函数
    // $cookie = cookie('name','zhangsan',2);
    // return response('测试产生cookie2')->cookie($cookie);
     //第三种队列形式设置
     Cookie::queue(Cookie::make('numer','18',3));
   }
  
    public function ajaxsend(){
    	//接受注册页面的手机号
    	$moblie = '17320674852';
    	//$moblie = request()->moblie;
        $code = rand(1000,9999);
       
        $res = $this->sendSms($moblie,$code);
        
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();

        
       

    	}
      
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


