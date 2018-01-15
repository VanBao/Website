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
               <form class="form-horizontal" action="{{route('answer2')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                     <label for="message" class="col-sm-2 control-label">Mô tả</label>
                     <div class="col-sm-10">
                        <textarea class="form-control" rows="5" name="message" id="message" required></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Trả lời</button>
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
            @if(Session::exists("messageSuccess"))
            <div class="alert alert-success text-center">
               <span class="h4">{{session("messageSuccess")}}<span><br/>
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
   @if(Session::exists("messageSuccess"))
      $("#myModal").modal("show");
   @endif
</script>
@endsection