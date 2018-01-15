<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
      <style>
         body { font-family: DejaVu Sans, sans-serif; }
      </style>
   </head>
   <body>
      <div class="container" style="padding-top: 20px; padding-bottom: 20px; font-size: 16px;">
         <div class="row" style="padding-bottom: 20px;">
            <div class="col-xs-2"><span class="h2 text-uppercase" style="font-family: DejaVu Sans, sans-serif; "><strong>Nhóm 10</strong></span></div>
            <div class="col-xs-10"><span class="text-uppercase h3 text-center" style="font-family: DejaVu Sans, sans-serif; "><strong>Website thương mại điện tử - Mua bánh trực tuyến</strong><span></div>
         </div>
         <span>Mã đơn hàng: <strong>#{{$bill->id}}</strong></span><br/>
         <span>Ngày đặt hàng: {{date("d-m-Y", strtotime($bill->created_at))}}</span><br/><br/>
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Thông tin thanh toán</th>
                  <th>Địa chỉ giao hàng</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>
                     <span><strong>{{$bill->Customer->name}}</strong></span><br/>
                     <span>{{$bill->Customer->email}}</span><br/>
                     <span>{{$bill->Customer->phone_number}}</span>
                  </td>
                  <td>
                     <span><strong>{{$bill->Customer->name}}</strong></span><br/>
                     <span>{{$bill->Customer->address}}</span><br/>
                  </td>
               </tr>
            </tbody>
         </table>
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Giảm giá</th>
                  <th>Tổng</th>
               </tr>
            </thead>
            <tbody>
               @php
                $total = 0;
               @endphp
               @foreach($bill->BillDetail as $billDetail)
               <tr>
                  <td>{{$billDetail->Product->name}}</td>
                  <td>{{$billDetail->quantity}}</td>
                  <td>{{number_format($billDetail->Product->price)}}<sup>đ</sup></td>
                  <td>{{number_format($billDetail->Product->promotion)}}<sup>đ</sup></td>
                  <td>
                     @if($billDetail->Product->promotion == 0)
                     {{number_format($billDetail->Product->price * $billDetail->quantity)}}
                     @php
                     $total += $billDetail->Product->price * $billDetail->quantity;
                     @endphp
                     @else
                     {{number_format($billDetail->Product->promotion * $billDetail->quantity)}}
                     @php
                     $total += $billDetail->Product->promotion * $billDetail->quantity;
                     @endphp
                     @endif
                     <sup>đ</sup>
                  </td>
               </tr>
               @endforeach
            </tbody>
            <tfoot>
               <tr>
                  <td colspan="4" class="text-right"><strong>Tổng</strong></td>
                  <td>{{number_format($total)}}<sup>đ</sup></td>
               </tr>
               <tr>
                  <td colspan="4" class="text-right"><strong>Phí vận chuyển</strong></td>
                  <td>0<sup>đ</sup></td>
               </tr>
               <tr>
                  <td colspan="4" class="text-right"><strong>Tổng cộng</strong></td>
                  <td>{{number_format($total)}}<sup>đ</sup></td>
               </tr>
            </tfoot>
         </table>
      </div>
   </body>
</html>