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
               <form class="form-horizontal" action="{{route('privilege2')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input type="hidden" name="id" value="{{$staff->id}}">
                  <div class="form-group">
                     <label for="level" class="col-sm-2 control-label">Vai trò</label>
                     <div class="col-sm-10">
                        <select class="form-control" name="level" id="level">
                           <option value="1"
                           @if($staff->level == 2)
                              {{"selected"}}
                           @endif 
                           >Nhân viên</option>
                           <option value="2"
                           @if($staff->level == 1)
                              {{"selected"}}
                           @endif 
                           >Quản lý</option>
                        </select>
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
@endsection