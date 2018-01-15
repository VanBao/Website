@extends("index")
@section('title')
Giỏ hàng
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="{{route('home')}}">Trang chủ</a></li>
      <li class="active">giỏ hàng</li>
   </ol>
   <div class="table-responsive">
      <table class="table h4">
         <thead>
            <tr class="info">
               <th class="text-center">Hình</th>
               <th class="text-center">Tên</th>
               <th class="text-center">Số lượng</th>
               <th class="text-center">Giá</th>
               <th class="text-center">Thành tiền</th>
            </tr>
         </thead>
         <tbody class="text-center">
           @if(count($products) != 0)
               @foreach($products as $product)
                  <tr>
                     <td style="width: 25%;"><img src='{{URL::asset("images/$product->path")}}'  class="img-responsive"></td>
                     <td>{{$product->name}}</td>
                     <td>
                        <input class="text-center quantity" type="number" id="{{$product->id}}quantity" value="{{$cart[$product->id]}}" min="1"><br/>
                        <p>
                           <span class="delete">
                              <span class="glyphicon glyphicon-trash" id="{{$product->id}}delete" aria-hidden="true"></span>Xóa
                           </span>
                           <span class="update">
                              <span class="glyphicon glyphicon-refresh" id="{{$product->id}}quantity" aria-hidden="true"></span>Cập nhật
                           </span>
                        </p>
                     </td>
                     <td>
                        @if($product->promotion == 0)
                           {{number_format($product->price)}}
                        @else
                           {{number_format($product->promotion)}}
                        @endif
                        <sup>đ</sup>
                     </td>
                     <td>
                        @if($product->promotion == 0)
                           {{number_format($product->price * $cart[$product->id])}}
                        @else
                           {{number_format($product->promotion * $cart[$product->id])}}
                        @endif
                        <sup>đ</sup>
                     </td>
                  </tr>
               @endforeach
           @else
               <tr>
                  <td colspan="5" class="text-center">{{"Không có sản phẩm."}}</td>
               </tr>
           @endif
         </tbody>
         <tfoot>
            <tr>
               <td><a href="{{route('home')}}" id="continue">&lt;&lt;&lt;&lt;&lt;&lt; Tiếp tục mua</a></td>
               <td colspan="3" class="text-center">Tổng giá trị đơn hàng: {{number_format(session("cart")->cost())}}<sup>đ</sup></td>
               <td class="text-right"><a id="order" href="javascript:void(1)" data-toggle="modal" data-target="#OrderModal">Đặt hàng &gt;&gt;&gt;&gt;&gt;&gt;</a></td>
            </tr>
         </tfoot>
      </table>
      <script type="text/javascript">
         $(".delete").click(function(){
            var id = parseInt($($(this).children("span")[0]).attr("id"));
            window.location.href = "http://localhost:8080/final/xoa-sp-gio-hang/" + id;
         });
         $(".update").click(function(){
            var id = parseInt($($(this).children("span")[0]).attr("id"))
            var quantity = $("#" +  id + "quantity").val();
            window.location.href = "http://localhost:8080/final/cap-nhat-gio-hang/" + id + "/" + quantity;
         });
      </script>
      <div id="OrderModal" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center">Phiếu đặt hàng</h4>
               </div>
               <div class="modal-body">
                  <form class="form-horizontal" action="{{route('order')}}" method="post">
                     <input type="hidden" name="_token" value="{{csrf_token()}}" />
                     @if(!Auth::check())
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="name" id="name" required/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="phonenumber" class="col-sm-2 control-label">Số ĐT</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="phonenumber" id="phonenumber" required/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                           <input type="email" class="form-control" name="email" id="email" required/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="address" id="address" required/>
                        </div>
                     </div>   
                     @endif
                     <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Tin nhắn</label>
                        <div class="col-sm-10">
                           <textarea style="resize: none;" id="message" class="form-control" name="message" rows="5"></textarea>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" type="button" class="btn btn-primary">Đặt hàng</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
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
            @if(Session::exists("messageFailed"))
               <div class="alert alert-warning text-center">
                  <span class="h4">{{session("messageFailed")}}<span><br/>
               </div>
            @elseif(Session::exists("messageSuccessful"))
               <div class="alert alert-success text-center">
                  <span class="h4">{{session("messageSuccessful")}}<span><br/>
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
   @if(Session::exists("messageFailed") or Session::exists("messageSuccessful"))
      $("#myModal").modal("show");
   @endif
</script>
@endsection