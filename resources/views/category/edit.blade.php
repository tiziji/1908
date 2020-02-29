<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<center><h1>分类修改列表</h1></center>

<!-- @if ($errors->any())
<div class="alert alert_danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/category/update/'.$res->c_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$res->c_name}}" name="c_name" id="firstname" 
				   >
				   <b style="color:red">{{$errors->first('c_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">父级id</label>
		<div class="col-sm-8">
        <select name="p_id">

            @foreach($data as $v)
              <option value="{{$v->c_id}}" {{$res->p_id==$v->p_id?'selected':''}}>{{str_repeat('|---',$v->level)}}{{$v->c_name}}</option>
            @endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
                 <textarea name="c_desc"  class="form-control desc"cols="30" rows="10">{{$res->c_desc}}</textarea>
                  <b style="color:red">{{$errors->first('c_desc')}}</b>

		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button id="_btn" type="button" class="btn btn-default">修改<tton>
		</div>
	</div>
</form>

</body>
<ml>
<script src="/static/jquery.min.js"></script>
<script>
$.ajaxSetup({ 
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
                });
$(function(){
    var c_id = {{$res->c_id}}
    //表单添加验证
    $("#_btn").click(function(){
        var flag=true;
        var c_name = $("input[name='c_name']").val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]+$/;
            if(!reg.test(c_name)){
                $("input[name='c_name']").next().html('数字字母下划线中文组成');
              return;
            }
           
            //验证唯一性
            $.ajax({
                url:"/category/checkOnly",
                data:{c_name:c_name,c_id:c_id},
                type:"post",
                async:false,
                dataType:'json',
                success:function(res){
                    if(res.count>0){
                   $("input[name='c_name']").next().html('标题已存在');
                   flag=false;
                    }
                }         
    })
          if(!flag){
             return;
          }

         var c_desc= $('.desc').val();
      
         if(c_desc==''){
            $(".desc").next().html('分类描述不能为空');
            return;
         } 
         $('form').submit();
    })
    //js验证描述
   $(".desc").blur(function(){
       var c_desc = $(this).val();
       if(c_desc==''){
         $(this).next().html('分类描述必填');
         return;
       }
   })
    //js验证分类名称
    $("input[name='c_name']").blur(function(){
        var c_name = $(this).val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]+$/;
            if(!reg.test(c_name)){
              $(this).next().html('数字字母下划线中文组成');
              return;
            }
            $.ajaxSetup({ 
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
                });
            //验证唯一性
            $.ajax({
                url:"/category/checkOnly",
                data:{c_name:c_name,c_id:c_id},
                type:"post",
                dataType:'json',
                success:function(res){
                    if(res.count>0){
                   $("input[name='c_name']").next().html('标题已存在');
                    }
                }

    })
})
})
</script>