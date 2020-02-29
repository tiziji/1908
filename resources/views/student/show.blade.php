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
<center><h1>学生信息修改</h1></center>
<form  action="{{url('/student/update/'.$data->s_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$data->s_name}}" name="s_name" id="firstname" 
				   placeholder="请输入名字">
				   <b style="color:red">{{$errors->first('s_name')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$data->s_sex}}" name="s_sex" id="firstname" 
				   placeholder="请输入性别">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$data->s_class}}" name="s_class" id="firstname">
			<b style="color:red">{{$errors->first('s_class')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">成绩</label>
		<div class="radio">
    <label>
        <input type="text" value="{{$data->s_goods}}" name="s_goods" id="optionsRadios1" ><br><br>
		<b style="color:red">{{$errors->first('s_goods')}}</b>

    </label>
</div>
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