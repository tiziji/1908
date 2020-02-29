
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
<center><h1>商品展示列表</h1></center>
<form action="">
  <input type="text" name="g_name" placeholder="请输入商品名称">
  <input type="submit" value="搜索">
</form>
<table class="table">
  
  <thead>
       <tr>
           <th>商品ID</th>
           <th>商品名称</th>
           <th>商品货号</th>
           <th>商品价格</th>
           <th>商品图片</th>
           <th>商品库存</th>
           <th>是否精品</th>
           <th>是否热销</th>
           <th>商品详情</th>
           <th>品牌名称</th>
           <th>分类名称</th>
           <th>商品相册</th>
           <th>操作</th>
       </tr>
  </thead>
  <tbody>
      @foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->g_id}}</td>
           <td>{{$v->g_name}}</td>
           <td>{{$v->g_order}}</td>
           <td>{{$v->g_price}}</td>
           <td>@if($v->g_img)<img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" width="30" height="30">@endif</td>
           <td>{{$v->g_num}}</td>
           <td>{{$v->g_good==1?'√':'×'}}</td>
           <td>{{$v->g_hoot==1?'√':'×'}}</td>
           <td>{{$v->g_desc}}</td>
           <td>{{$v->g_id}}</td>
           <td>{{$v->c_id}}</td>
           <td>
            @if ($v->g_imgs)
             @php $photos = explode('|',$v->g_imgs); @endphp
             @foreach($photos as $vv)
             @if($v->g_imgs)<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="30" height="30">@endif
             @endforeach
            @endif
           </td>
           <td>
            <a href="{{url('goods/edit/'.$v->g_id)}}" class="btn btn-info">编辑</a>
            <a href="{{url('goods/destroy/'.$v->g_id)}}" class="btn btn-danger">删除</a>
          </td>
          </tr>
       @endforeach
  </tbody>
</table>
</body>
<ml>