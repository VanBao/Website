@foreach($products as $product)
<div class="col-md-4 col-sm-6">
   <div class="thumbnail product">
      <img src='{{URL::asset("images/$product->path")}}' width="100%" class="img-responsive img" />
      <div class="product-infor">
         <div class="pull-left" style="width: 100px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$product->name}}">{{$product->name}}</div>
         <div class="pull-right">
            {{number_format($product->price)}}<sup>đ</sup>
            @if($product->promotion != 0)
            &nbsp;&nbsp;<span class="label label-danger" style="font-size: 14px;">-{{(($product->price - $product->promotion) / $product->price)*100}}%</span>
            @endif
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="middle">
         <a class="text" href="{{route('product-detail', ['name'=>$product->unsigned_name])}}">Xem</a>
      </div>
   </div>
</div>
@endforeach