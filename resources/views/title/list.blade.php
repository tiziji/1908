<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="">
文章标题：<input type="text" name="t_name" >
<select name="t_type">
<option value="">请选择</option>
   <option value="后楼梦">后楼梦</option>
   <option value="西游记">西游记</option>
   <input type="submit" value="搜索">
</select>
</form>
    <form action="">
    <table border=1>
          <tr>
          <td>编号</td>
          <td>文章标题</td>
          <td>文章分类</td>
          <td>文章重要性</td>
          <td>是否显示</td>
          <td>文章作者</td>
          <td>作者Email</td>
          <td>关键字</td>
          <td>网页描述</td>
          <td>图片</td>
          <td>添加日期</td>
          <td>操作</td>
         
          </tr>
          @foreach($data as $k=>$v)
          <tr>
          <td>{{$v->t_id}}</td>
          <td>{{$v->t_name}}</td>
          <td>{{$v->t_t_type=='红楼梦'?'红楼梦':'西游记'}}</td>
          <td>{{$v->t_goods==1?'普通':'置顶'}}</td>
          <td>{{$v->t_show==1?'显示':'不显示'}}</td>
          <td>{{$v->t_author}}</td>
          <td>{{$v->t_email}}</td>
          <td>{{$v->t_gjz}}</td>
          <td>{{$v->t_desc}}</td>
         <td>@if($v->t_img)<img src="{{env('UPLOAD_URL')}}{{$v->t_img}}" width="30" height="30">@endif</td>
          <td>{{date('Y-m-d H:i:s',$v->t_time)}}</td>
          <td>
          <a href="javacript:void(0)" onclick="del({{$v->t_id}})">删除</a>
          <a href="{{url('title/edit/'.$v->t_id)}}">编辑</a>
           </td>

          </tr>  
          @endforeach

    </table>
    {{$data->appends(['t_name'=>$t_name,'t_type'=>$t_type])->links()}}
    </form>
</body>
</html>
<script src="/static/jquery.min.js"></script>
<script>
 function del(id){
    if(!id){
        return;
    }
    if(confirm('是否确认删除？')){
       $.get('/title/destroy/'+id,function(res){
        if(res.code=='00000'){
           location.reload();
        }
       },
       
       'json')
    }
 }
</script>