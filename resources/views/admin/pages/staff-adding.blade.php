@extends("admin.index")
@section("content")
<div id="page-wrapper">
   <div class="row">
      <div class="col-lg-12">
         <h1 class="page-header"></h1>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
               <form class="form-horizontal" action="{{route('addStaff')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Tên</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="email" class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="phoneNumber" class="col-sm-2 control-label">Số điện thoại</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Số điện thoại" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control number" name="address" id="address" placeholder="Địa chỉ" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="password2" class="col-sm-2 control-label">Mật khẩu 2</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Nhập lại mật khẩu" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="gender" class="col-sm-2 control-label">Giới tính</label>
                     <div class="form-group">
                        &nbsp;&nbsp;&nbsp;<label class="radio-inline">
                           <input type="radio" checked name="gender" id="gender" value="1"> Nam
                        </label>
                        <label class="radio-inline">
                           <input type="radio" name="gender" id="gender" value="0"> Nữ
                        </label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="level" class="col-sm-2 control-label">Vai trò</label>
                     <div class="col-sm-10">
                        <select class="form-control" name="level" id="level">
                           <option value="1">Nhân viên</option>
                           <option value="2">Quản lý</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Thêm</button>
                     </div>
                  </div>
               </form>
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
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
            @endif
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   @if(count($errors) > 0)
      $("#myModal").modal("show");
   @endif
</script>
@endsection