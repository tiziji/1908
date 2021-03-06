<?php
/**
 * 公用的方法 返回json数据 进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 * 
 */
function showMsg($status,$message='',$data=array()){
  $result = array(
     'status' => $status,
     'message' => $message,
     'data' => $data,
  );
  exit(json_encode($result));
}
 function CreateTree($data,$p_id=0,$level=1){
    if(!$data){
      return;
    }
    static $info = [];
    foreach($data as $k=>$v){
      if($v->p_id==$p_id){
          $v->level = $level;
          $info[] = $v;
         CreateTree($data,$v->c_id,$level+1);
      }
    }
    return $info;
}
//多文件上传
function Moreupload($filename){
  $photo = request()->file($filename);
  if(!is_array($photo)){
     return;
  }
   foreach( $photo as $v){
      if($v->isValid()){
         $store_result[] = $v->store('uploads');
      }
   }  
  return $store_result;
}
//单文件上传
   function upload($filename){
  //判断上传是否有错误
  if(request()->file($filename)->isValid()){
      //接受值
     $photo = request()->file($filename);
      //上传
      $store_result = $photo->store('uploads');
      return $store_result;
  }
  exit('未获取到上传文件或上传过程出错');
}