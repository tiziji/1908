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
<center><h1>管理员修改页面</h1></center>

<!-- @if ($errors->any())
<div class="alert alert_danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/user/update/'.$res->u_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$res->u_name}}" name="u_name" id="firstname" 
				   >
				   <b style="color:red">{{$errors->first('u_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$res->u_tel}}" name="u_tel" id="firstname" 
				  >
                  <b style="color:red">{{$errors->first('u_tel')}}</b>

		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$res->u_email}}" name="u_email" id="firstname" 
				  >
                  <b style="color:red">{{$errors->first('u_email')}}</b>

		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-8">
        <img src="{{env('UPLOAD_URL')}}{{$res->u_img}}" width="30" height="30">
			<input type="file" name="u_img" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改<tton>
		</div>
	</div>
</form>

</body>
<ml>