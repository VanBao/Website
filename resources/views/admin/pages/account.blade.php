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
               <form class="form-horizontal" action="{{route('accountAdmin')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Tên</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên" value="{{Auth::guard('admin')->user()->name}}" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="phonenumber" class="col-sm-2 control-label">Số điện thoại</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Số điện thoại" value="{{Auth::guard('admin')->user()->phone_number}}" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control number" name="address" id="address" placeholder="Địa chỉ" value="{{Auth::guard('admin')->user()->address}}" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="gender" class="col-sm-2 control-label">Giới tính</label>
                     <div class="form-group">
                        &nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline">
                           <input type="radio" name="gender" id="gender" value="1" 
                           @if(Auth::guard('admin')->user()->gender == 1)
                              {{"checked"}}
                           @endif
                           > Nam
                        </label>
                        <label class="radio-inline">
                           <input type="radio" name="gender" id="gender" value="0"
                           @if(Auth::guard('admin')->user()->gender == 0)
                              {{"checked"}}
                           @endif
                           > Nữ
                        </label>
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