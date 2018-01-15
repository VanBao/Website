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
               <form class="form-horizontal" action="{{route('changePasswordAdmin')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <div class="form-group">
                     <label for="password" class="col-sm-2 control-label">Mật khẩu mới</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu mới" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="password2" class="col-sm-2 control-label">Nhập lại</label>
                     <div class="col-sm-10">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Nhập lại mật khẩu mới" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Cập nhật</button>
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