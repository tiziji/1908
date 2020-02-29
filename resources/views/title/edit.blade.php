<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
</head>
<body>

    <form action="{{url('title/update/'.$res->t_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    文章标题：<input type="text" name="t_name" value="{{$res->t_name}}">           <b style="color:red">{{$errors->first('t_name')}}</b>
<br/>
    文章分类：<select name="t_type">
    
                 <option value="1">红楼梦</option>
                 <option value="2">西游记</option>

                 </select><br/>
    文章重要性：<input type="radio" value="1" name="t_goods" {{$res->t_goods==1?"checked":""}}>普通<input type="radio" value="2" name="t_goods" {{$res->t_goods==2?"checked":""}}>置顶<br/>
    是否显示：<input type="radio" value="1" name="t_show" {{$res->t_goods==1?"checked":""}}>显示<input type="radio" value="2" name="t_show" {{$res->t_goods==2?"checked":""}}>不显示<br/>
    文章作者：<input type="text" name="t_author" value="{{$res->t_author}}"><b style="color:red">{{$errors->first('t_author')}}</b><br>
    作者email：<input type="text" name="t_email" value="{{$res->t_email}}"><b style="color:red">{{$errors->first('t_email')}}</b><br/>           
    关键字<input type="text" name="t_gjz" value="{{$res->t_gjz}}"><b style="color:red">{{$errors->first('t_gjz')}}</b><br/>           

    网页描述：<textarea name="t_desc" id="" cols="30" rows="10">{{$res->t_desc}}</textarea><b style="color:red">{{$errors->first('t_desc')}}</b>
<br/>           
    上传文件<img src="{{env('UPLOAD_URL')}}{{$res->t_img}}" width="30" height="30">
<input type="file" name="t_img"><br/>
    <input type="button" value="修改"><input type="reset" value="重置">

    </form>
</body>
</html>
<script src="/static/jquery.min.js"></script>
<script>
$(function(){
    var t_id = {{$res->t_id}}
    $('input[type=button]').click(function(){
        var titleflag=true;
        var title = $('input[name="t_name"]').val();
        
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]+$/;
            if(!reg.test(title)){
                $('input[name="t_name"]').next().html('文章标题由中文子母数字组成');
              return;
            }
            $.ajax({
                url:"/title/checkOnly",
                data:{title:title,t_id:t_id},
                type:"post",
                async:false,
                dataType:'json',
                success:function(res){
                    if(res.count>0){
                   $('input[name="t_name"]').next().html('标题已存在');
                 
                   titleflag=false;
                    }
                }

                

            })
            if(!titleflag){
             return;
            }

            var author =$('input[name="t_author"]').val();
    
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]{2,8}$/;
        if(!reg.test(author)){
            $('input[name="t_author"]').next().html('作者名称由中文字母数字2-8位组成');
           return;
        }
              $('form').submit();
     })

    $('input[name="t_author"]').blur(function(){
        $(this).next().html('');

        var author = $(this).val();
     
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]{2,8}$/;
        if(!reg.test(author)){
           $(this).next().html('作者名称由中文字母数字2-8位组成');
           return;
        }
    })

    $('input[name=t_name]').blur(function(){
// alert(8);

          $(this).next().html('');
        var title = $(this).val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z]+$/;
            if(!reg.test(title)){
              $(this).next().html('文章标题由中文子母数字组成');
              return;
            }
            $.ajaxSetup({ 
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
                });
            //验证唯一性
            $.ajax({
                url:"/title/checkOnly",
                data:{title:title,t_id:t_id},
                type:"post",
                dataType:'json',
                success:function(res){
                    if(res.count>0){
                   $('input[name="t_name"]').next().html('标题已存在');
                    }
                }

                

            })

     })
})
</script>