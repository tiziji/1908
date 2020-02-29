
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
<center><h1>学生信息展示</h1></center>
<form action="">
    <input type="text" name="s_name" value="{{$s_name}}" placeholder="请输入姓名">    <input type="text" name="s_class" value="{{$s_class}}" placeholder="请输入班级">
<input type="submit" value="搜索">
</form>
<table class="table">
  
  <thead>
       <tr>
           <th>ID</th>
           <th>学生姓名</th>
           <th>学生性别</th>
           <th>班级</th>
           <th>成绩</th>
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($res as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->s_id}}</td>
           <td>{{$v->s_name}}</td>
           <td>{{$v->s_sex}}</td>
           <td>{{$v->s_class}}</td>
           <td>{{$v->s_goods}}</td>
           <td> <a href="{{url('student/edit/'.$v->s_id)}}" class="btn btn-info">编辑</a> 
           <a href="{{url('student/destroy/'.$v->s_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       @endforeach
       <tr><td colspan="7">{{$res->appends(['s_name'=>$s_name,'s_class'=>$s_class])->links()}}</td></tr>
  </tbody>
</table>
</body>
<ml>