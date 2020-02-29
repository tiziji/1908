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
<center><h1>学生信息添加</h1></center>
<form  action="{{url('/student/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="s_name" id="firstname" 
				   placeholder="请输入名字">
				   <b style="color:red">{{$errors->first('s_name')}}</b>

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<label>
        <input type="radio" name="s_sex" id="optionsRadios1" value="1" checked>男<br><br>
        <input type="radio" name="s_sex" id="optionsRadios1" value="2">女
        
    </label>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="s_class" id="firstname">
			<b style="color:red">{{$errors->first('s_class')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">成绩</label>
		<div class="radio">
    <label>
        <input type="text" name="s_goods" id="optionsRadios1" ><br><br>
		<b style="color:red">{{$errors->first('s_goods')}}</b>
    </label>
</div>
	</div>
	
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加<tton>
		</div>
	</div>
</form>

</body>
<ml>