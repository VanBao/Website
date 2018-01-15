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
                           <th>Giá</th>
                           <th>Giá KM</th>
                           <th>Trạng thái</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($arrProduct as $product)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$product->name}}</td>
                           <td>{{number_format($product->price)}}<sup>đ</sup></td>
                           <td>{{number_format($product->promotion)}}<sup>đ</sup></td>
                           <td class="updateStatus" style="cursor: pointer;" id="{{$product->id}}status" title="Click để thay đổi">
                              @if($product->status == 1)
                              {{"Còn hàng"}}
                              @else
                              {{"Hết hàng"}}
                              @endif
                           </td>
                           <td>
                              <a href="{{route('productDeleting',['id'=>$product->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('productUpdate',['id'=>$product->id])}}" class="label label-info">Thay đổi</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.table-responsive -->
               {{$arrProduct->links()}}
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
            url: "{{route('updateStatusProduct')}}",
            method: "GET",
            data: { id : id },
            dataType: "json"
         });
   
         request.done(function( data ) {
            alert("Cập nhật thành công");
            console.log(data);
            if(data.status == 1){
               $("#" + id + "status").text("Còn hàng");
            }else{
               $("#" + id + "status").text("Hết hàng");
            }
         });
      });
   });
</script>
@endsection