@extends("index")
@section('title')
Tài khoản
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="index.html">Trang chủ</a></li>
      <li class="active">tài khoản</li>
   </ol>
   <div class="row">
      <div class="col-md-9">
         <div class="table-responsive">
            <table class="table table-bordered text-center h4">
               <thead>
                  <tr>
                     <th class="text-center">STT</th>
                     <th class="text-center">Thời gian</th>
                     <th class="text-center">Tổng tiền</th>
                     <th class="text-center">
                        Chi tiết
                     </th>
                     <th class="text-center">Trạng thái</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($bills) != 0)
                     @foreach($bills as $bill)
                     <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$bill->created_at}}</td>
                        <td>{{number_format($bill->total)}}<sup>đ</sup></td>
                        <td>
                           <table class="table table-bordered">
                                 <tr>
                                    <th class="text-center">Tên SP</th>
                                    <th class="text-center">SL</th>
                                 </tr>
                              @foreach($bill->BillDetail as $billDetail)
                                 <tr>
                                    <td class="option_label">{{$billDetail->Product->name}}</td>
                                    <td class="option_content">{{$billDetail->quantity}}</td>
                                 </tr>
                              @endforeach
                           </table>
                        </td>
                        <td>
                           @if($bill->status == 1)
                              {{"Đã giao hàng"}}
                           @else
                              {{"Chưa giao hàng"}}
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  @else
                     <tr><td colspan="5">Không có</td></tr>
                  @endif
               </tbody>
            </table>
         </div>
         {{$bills->links()}}
      </div>
      <div class="col-md-3">
         <div class="user-infor">
            <h3>Quản lý tài khoản</h3>
            <ul class="h4">
               <li><a href="{{route('changePassword')}}">Thay đổi mật khẩu</a></li>
               <li><a href="{{route('changeInformation')}}">Thay đổi thông tin</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
@endsection