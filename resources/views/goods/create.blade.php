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
<center><h1>商品添加列表</h1></center>

<!-- @if ($errors->any())
<div class="alert alert_danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="g_name" id="firstname" 
				   >
				   <b style="color:red">{{$errors->first('g_name')}}</b>
		</div>
	</div>
	<!-- <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="g_order" id="firstname" 
				  >
				   <b style="color:red">{{$errors->first('g_order')}}</b>

		</div>
	</div> -->
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="g_price" id="firstname" 
				   >
                   <b style="color:red">{{$errors->first('g_price')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-8">
			<input type="file" name="g_img" class="form-control">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="g_num" id="firstname" 
				   >
                   <b style="color:red">{{$errors->first('g_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="radio">
    <label>
        <input type="radio" name="g_good" id="optionsRadios1" value="1" >是<br><br>
        <input type="radio" name="g_good" id="optionsRadios1" value="2" checked>否
        
    </label>
</div>
<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="radio">
    <label>
        <input type="radio" name="g_hot" id="optionsRadios1" value="1" >是<br><br>
        <input type="radio" name="g_hot" id="optionsRadios1" value="2" checked>否
        
    </label>
</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-8">
         <textarea name="g_desc" cols="30" rows="10"></textarea>
         <b style="color:red">{{$errors->first('g_desc')}}</b>
 		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" name="g_imgs[]" multiple="multiple" class="form-control">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌id</label>
		<div class="col-sm-8">
           <select name="b_id" id="">
            @foreach($brand as $k=>$v)
              <option value="{{$v->b_id}}">{{$v->b_name}}</option>
              @endforeach
           </select>
 		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类id</label>
		<div class="col-sm-8">
           <select name="c_id" id="">
           @foreach($cate as $k=>$v)
              <option value="{{$v->c_id}}">{{str_repeat('|---',$v->level)}}{{$v->c_name}}</option>
              @endforeach
           </select>
 		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加<button>
		</div>
	</div>
</form>

</body>
<ml>