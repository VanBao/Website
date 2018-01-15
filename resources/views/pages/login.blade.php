@extends("index")
@section('title')
Đăng nhập
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="index.html">Trang chủ</a></li>
      <li class="active">đăng nhập</li>
   </ol>
   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-default" style="margin: 65px 0px;">
            <div class="panel-heading">
               <h3 class="panel-title text-center"><span class="h3 text-uppercase">Đăng nhập</span></h3>
            </div>
            <div class="panel-body">
               <form action="{{route('login')}}" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}" />
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                  </div>
                  <br/>
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
                  </div>
                  <br/>
                  <div class="form-group text-right">
                     <button type="submit" class="btn btn-success">Đăng nhập</button>
                  </div>
               </form>
               <hr/>
               <div class="row">
                  <div id="foget-password-text" class="col-md-9 col-sm-12 text-center">
                     <span>Bạn chưa có tài khoản. <a href="{{route('register')}}">Vui lòng đăng ký tại đây.</a></span>
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
@endsection