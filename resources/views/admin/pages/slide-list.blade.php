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
                           <th>Hình</th>
                           <th>Trạng thái</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($arrSlide as $slide)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$slide->name}}</td>
                           <td><img src='{{asset("images/$slide->path")}}' class="img-responsive" alt="{{$slide->name}}" /></td>
                           <td class="updateStatus" style="cursor: pointer;" id="{{$slide->id}}status" title="Click để thay đổi">
                              @if($slide->status == 1)
                              {{"Hiển thị"}}
                              @else
                              {{"Ẩn"}}
                              @endif
                           </td>
                           <td>
                              <a href="{{route('slideDeleting',['id'=>$slide->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('slideUpdate',['id'=>$slide->id])}}" class="label label-info">Thay đổi</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.table-responsive -->
               {{$arrSlide->links()}}
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
      $(".updateStatus").click(function(){
         var id = parseInt($(this).attr("id"));
         var request = $.ajax({
            url: "{{route('updateStatusSlide')}}",
            method: "GET",
            data: { id : id },
            dataType: "json"
         });
   
         request.done(function( data ) {
            alert("Cập nhật thành công");
            console.log(data);
            if(data.status == 1){
               $("#" + id + "status").text("Hiển thị");
            }else{
               $("#" + id + "status").text("Ẩn");
            }
         });
      });
   });
</script>
@endsection