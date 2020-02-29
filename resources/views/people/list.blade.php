
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>外来人口展示</h1></center>
<form action="">
  <input type="text" name="username" value="{{$username}}" placeholder="请输入用户名">
  <input type="submit" value="搜索">

</form>
<table class="table">
  
  <thead>
       <tr>
           <th>ID</th>
           <th>用户名</th>
           <th>年龄</th>
           <th>身份证号</th>
           <th>头像</th>
           <th>是否湖北人</th>
           <th>添加时间</th>
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->p_id}}</td>
           <td>{{$v->username}}</td>
           <td>{{$v->age}}</td>
           <td>{{$v->card}}</td>
           <td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="30" height="30">@endif</td>
           <td>{{$v->is_hubei==1?'√':'×'}}</td>
           <td>{{date('Y-m-d,h:i:s',$v->add_time)}}</td>
           <td> <a href="{{url('people/edit/'.$v->p_id)}}" class="btn btn-info">编辑</a> <a href="{{url('people/destroy/'.$v->p_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       
       @endforeach
       <tr><td colsapn="7">{{$data->appends(['username'=>$username])->links()}}</td></tr>
  </tbody>
</table>
</body>
<ml>
<script>
$(document).on('click','.pagination a',function(){
  var url=$(this).attr('href');
  //console.log(url);
  if(!url){
       return;
  }
  $.get(url,function(res){
    $('tbody').html(res);
  })
  return false;
})
</script>