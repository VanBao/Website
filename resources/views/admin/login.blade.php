<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('images/admin-icon.png')}}"/>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{route('loginAdmin')}}" method="POST">
                            <fieldset>
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" type="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Mật khẩu" name="password" type="password" required>
                                </div>
                                <input type="submit" name="Login" value="Đăng nhập" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center h1">Thông báo</h4>
                </div>
                <div class="modal-body">
                    @if(Session::exists("messageFailed"))
                    <div class="alert alert-warning text-center">
                        <span class="h4">{{session("messageFailed")}}<span><br/>
            </div>
            @endif
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   @if(Session::exists("messageFailed"))
      $("#myModal").modal("show");
   @endif
</script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.js')}}"></script>
</body>
</html>