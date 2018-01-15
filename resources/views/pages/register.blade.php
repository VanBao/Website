@extends("index")
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="{{route('home')}}">Trang chủ</a></li>
      <li class="active">đăng ký</li>
   </ol>
   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-default" style="margin: 65px 0px;">
            <div class="panel-heading">
               <h3 class="panel-title text-center"><span class="h3 text-uppercase">Đăng ký</span></h3>
            </div>
            <div class="panel-body">
               <form action="{{route('register')}}" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}" />
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input id="name" type="text" class="form-control" name="name" placeholder="Họ tên" required/>
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                     <input id="email" type="email" class="form-control" name="email" placeholder="Email" required/>
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                     <input id="phonenumber" type="text" class="form-control" name="phonenumber" placeholder="Số điện thoại" required/>
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                     <input id="address" type="text" class="form-control" name="address" placeholder="Địa chỉ" required/>
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu" required/>
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input id="password2" type="password" class="form-control" name="password2" placeholder="Nhập lại mật khẩu" required/>
                  </div>
                  <br/>
                  <div class="form-group text-right">
                     <button type="submit" class="btn btn-success">Đăng ký</button>
                  </div>
               </form>
               <hr/>
               <div class="row">
                  <div id="foget-password-text" class="col-md-9 col-sm-12 text-center">
                     <span>Bạn đã có tài khoản. <a href="{{route('login')}}">Vui lòng đăng nhập tại đây.</a></span>
                  </div>
                  <div class="col-md-3 col-sm-12 text-center"><a href="{{route('resetPassword')}}">Quên mật khẩu.</a></div>
               </div>
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
            @if(count($errors) > 0)
            <div class="alert alert-warning text-center">
               @foreach($errors->all() as $error)
                  <span class="h4">{{$error}}<span><br/>
               @endforeach
            </div>
            @else
            <div class="alert alert-success text-center">
               <span class="h4">{{session("messageSuccessful")}}<span><br/>
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
   @if(count($errors) > 0 or Session::exists("messageSuccessful"))
      $("#myModal").modal("show");
   @endif
</script>
@endsection