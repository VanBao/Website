@extends("index")
@section('title')
Loại {{$categoryName}}
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="{{route('home')}}">Trang chủ</a></li>
      <li class="active">{{$categoryName}}</li>
   </ol>
   <div class="row" id="result">
      @foreach($products as $product)

         <div class="col-md-4 col-sm-6">
            <div class="thumbnail product">
               <img src='{{URL::asset("images/$product->path")}}' width="100%" class="img-responsive img" />
               <div class="product-infor">
                  <div class="pull-left" style="width: 200px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$product->name}}">{{$product->name}}</div>
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
   </div>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body">
               <p class="text-center h3">Đăng tải dữ liệu...</p>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
      var total = {{$total}};
      var currentPage = 1;
      $(window).scroll(function() {
         if($(window).scrollTop() + $(window).height() == $(document).height()) {
            if(currentPage != total){
               currentPage++;
               var request = $.ajax({
                  url: "http://localhost:8080/final/loai-san-pham/{{$unsigned_name}}/"+currentPage,
                  method: "GET",
                  dataType: "html"
                });
   
               request.done(function( data ) {
                  $("#result").append(data);
                  $("#myModal").modal("hide")
               });
            }
         }
      });
   })
   $( document ).ajaxStart(function() {
      $("#myModal").modal("show");
   });
</script>
@endsection