
@extends('layouts.shop')
@section('title','注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/regdo')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{URL('/login')}}">登陆</a></h3>
     @csrf
      <div class="lrBox">    
       <div class="lrList"><input type="text" name="moblie" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button type="button" id="asd">获取验证码</button></div>
       <div class="lrList"><input type="password" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="apwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
     <input type="submit" value="立即注册" />
      </div>
      
     </form><!--reg-login/-->
   
    <script src="/static/jquery.min.js"></script>
    <script>
    $('button').click(function(){
         var moblie = $('input[name="moblie"]').val();
         if(!moblie){
            alert('请输入手机号或邮箱');
            return;
         }
         $.get('/send',{moblie:moblie},function(res){
           if(res.code=='00000'){
              alert('发送成功');
           }
         },'json')
    })
    $('#asd').click(function(){
      //  alert(99);
         var moblie = $('input[name="moblie"]').val();
         if(!moblie){
            alert('请输入手机号或邮箱');
            return;
         }
         $.get('/sendemail',{moblie:moblie},function(res){
           if(res.code=='00000'){
              alert('发送邮箱成功');
           }
         },'json')
    })
    </script>
      @endsection