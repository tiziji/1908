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
    <table border=1>
       <tr>
       <td>用户id</td>
       <td>用户名称</td>
       <td>用户身份</td>
       <td>操作</td>
       </tr>
       @foreach($data as $k=>$v)
       <tr>
       <td>{{$v->id}}</td>
       <td>{{$v->username}}</td>
       <td>{{$v->user==2?'普通库管':'库管主管'}}</td>
       <td>
      
        <a href="{{url('staff/delete/'.$v->id)}}">删除</a>
        <a href="{{url('staff/addshow')}}">编辑</a>
       
       </td>
       </tr>
       @endforeach
    </table>
    </form>
</body>
</html>