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
               <div class="table-responsive">
                  <table width="100%" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>STT</th>
                           <th>Tên</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($arrCategory as $category)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$category->name}}</td>
                           <td>
                              <a href="{{route('categoryDeleting',['id'=>$category->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('categoryUpdate',['id'=>$category->id])}}" class="label label-info">Thay đổi</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
   </div>
</div>
{{$arrCategory->links()}}
@endsection