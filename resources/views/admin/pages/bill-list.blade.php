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
                           <th>Tên KH</th>
                           <th>Số ĐT</th>
                           <th>Địa chỉ</th>
                           <th>Ghi chú</th>
                           <th>Tổng</th>
                           <th>Trạng thái</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($arrBill as $bill)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$bill->Customer->name}}</td>
                           <td>{{$bill->Customer->phone_number}}</td>
                           <td>{{$bill->Customer->address}}</td>
                           <td>{{$bill->note}}</td>
                           <td>{{number_format($bill->total)}}<sup>đ</sup></td>
                           <td class="updateStatus" style="cursor: pointer;" id="{{$bill->id}}status" title="Click để thay đổi">
                              @if($bill->status == 1)
                              {{"Đã xử lý"}}
                              @else
                              {{"Chưa xử lý"}}
                              @endif
                           </td>
                           <td>
                              <a href="{{route('billDeleting',['id'=>$bill->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('billDetail',['id'=>$bill->id])}}" class="label label-info">Chi tiết</a>&nbsp;&nbsp;
                              <a href="{{route('pdf',['id'=>$bill->id])}}" class="label label-info">PDF</a> 
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.table-responsive -->
               {{$arrBill->links()}}
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
            url: "{{route('updateStatusBill')}}",
            method: "GET",
            data: { id : id },
            dataType: "json"
         });
   
         request.done(function( data ) {
            alert("Cập nhật thành công");
            console.log(data);
            if(data.status == 1){
               $("#" + id + "status").text("Đã xử lý");
            }else{
               $("#" + id + "status").text("Chưa xử lý");
            }
         });
      });
   });
</script>
@endsection