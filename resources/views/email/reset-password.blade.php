<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type="text/css" rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>
</head>
<body>
  <div class="container">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
      <div class="thumbnail">
      <span>Chào <em>{{$user->name}}</em>,</span><br/>
      <span>Mật khẩu mới của tài khoản là: {{$newPassword}}</span>
    </div>
    </div>
    <div class="col-xs-3"></div>
  </div>
</body>
</html>