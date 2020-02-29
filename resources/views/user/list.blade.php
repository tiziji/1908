
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
<center><h1>管理员列表展示</h1></center>

<table class="table">
  
  <thead>
       <tr>
           <th>ID</th>
           <th>管理员名称</th>
           <th>手机号</th>
           <th>邮箱</th>
           <th>头像</th>
           
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->u_id}}</td>
           <td>{{$v->u_name}}</td>
           <td>{{$v->u_tel}}</td>
           <td>{{$v->u_email}}</td>
           <td>@if($v->u_img)<img src="{{env('UPLOAD_URL')}}{{$v->u_img}}" width="30" height="30">@endif</td>
          
           <td> <a href="{{url('user/edit/'.$v->u_id)}}" class="btn btn-info">编辑</a> <a href="{{url('user/destroy/'.$v->u_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       
       @endforeach
  </tbody>
</table>
</body>
<ml>