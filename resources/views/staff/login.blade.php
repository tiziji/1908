<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
       <form action="{{url('staff/add')}}" method="post">
       @csrf

       用户名：<input type="text" name="username"><br/>
       密码：<input type="password" name="pwd"><br/>
       <input type="submit" value="登录">
       </form>
</body>
</html>