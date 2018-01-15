<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type="text/css" rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}"/>
</head>
<body>
  <div class="container">
    <p>Chào,<em>{{$contact->name}}</em></p>
	<p>{{$answer}}</p>
  </div>
</body>
</html>
