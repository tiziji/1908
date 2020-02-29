<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('sraff/doadd')}}" method="post">
    <table>
    用户名：<input type="text" name="username">
    密码：<input type="password" name="pwd">
    <input type="submit" value="添加">
    </table>
    </form>
</body>
</html>