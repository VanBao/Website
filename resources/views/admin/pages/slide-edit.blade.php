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
               <form class="form-horizontal" action="{{route('slideUpdate2')}}" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input type="hidden" name="id" value="{{$slide->id}}" />
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Tên</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Tên sản phẩm" value="{{$slide->name}}" required/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="image" class="col-sm-2 control-label">Hình ảnh</label>
                      <div class="col-sm-10">
                        <img src='{{asset("images/$slide->path")}}' alt="{{$slide->name}}"/>
                        <input type="file" class="form-control" name="image" id="image">
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
   $(document).ready(function(){
      CKEDITOR.replace( 'description',    
      {    
         filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Files') }}",
         filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Images') }}",
         filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Flash') }}",
         filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
         filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
         filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
      });
      $(".number").keypress(function (evt) {
         if($(this).val() < 1){
            evt.preventDefault();
            $(this).val(1);
         }
      });
   });
   
</script>
@endsection