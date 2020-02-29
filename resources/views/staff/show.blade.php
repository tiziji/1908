<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if($data->user==1)
     <a href="">货物管理</a> <a href="">出入库管理</a> <a href="{{url('/staff')}}">用户管理</a>
@endif
@if($data->user==2)
     <a href="">货物管理</a> <a href="">出入库管理</a> 
@endif
</body>
</html>