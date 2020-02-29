
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
<center><h1>分类列表展示</h1></center>

<table class="table">
  
  <thead>
       <tr>
           <th>分类id</th>
           <th>分类名称</th>
           <th>父级id</th>
           <th>分类描述</th>
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->c_id}}</td>
           <td>{{str_repeat('|---',$v->level)}}{{$v->c_name}}</td>
           <td>{{$v->p_id}}</td>
           <td>{{$v->c_desc}}</td>
           
           <td> <a href="{{url('category/edit/'.$v->c_id)}}" class="btn btn-info">编辑</a> <a href="javascript:void(0)" onclick="del({{$v->c_id}})" class="btn btn-danger">删除</a></td>
       </tr>
       
       @endforeach
  </tbody>
</table>
</body>
<ml>
<script>
function del(id){
   if(!id){
      return;
   }
   if(confirm('是否确认删除？')){
    $.get('/category/destroy/'+id,function(res){
        if(res.code=='00000'){
           location.reload();
        }
   },
   'json' )
}
}
</script>