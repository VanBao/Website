@extends("index")
@section('title')
Chi tiết {{$product->name}}
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="{{route('home')}}">Trang chủ</a></li>
      <li><a href="{{route('category', ['name'=>$product->Category->unsigned_name])}}">Loại {{$product->Category->name}}</a></li>
      <li class="active">{{$product->name}}</li>
   </ol>
   <div id="proinfo">
      <div class="row">
         <div class="box col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="box_article">
               <div class="box_content">
                  <img src='{{URL::asset("images/$product->path")}}' alt="">
               </div>
            </div>
         </div>
         <div class="box col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="buy_article">
               <div style="padding-top: 0" class="box_content">
                  <div class="page_title">
                     <h2>{{$product->name}}</h2>
                  </div>
                  @if($product->promotion != 0)
                     <p class="price h3">
                        <span class="old">{{number_format($product->price)}}<sup>đ</sup></span>&nbsp;&nbsp;-&nbsp;&nbsp;<span class="new">{{number_format($product->promotion)}}<sup>đ</sup></span>
                     </p>
                  @else
                     <p class="price h3">
                        <span class="new">{{$product->price}}<sup>đ</sup></span>
                     </p>
                  @endif
                  <div class="box_content_session">
                     <ul class="h3">
                        <li>Thời hạn sử dụng: {{$product->expiry_date}} ngày</li>
                        <li>Khối lượng: {{$product->weight}} gam</li>
                        <li>Xuất xứ: {{$product->origin}}</li>
                        <li>Trạng thái: 
                          @if($product->status == 1)
                            {{"Còn hàng"}}
                          @else
                            {{"Hết hàng"}}
                          @endif
                        </li>
                        <li class="rating rate_widget">
                           Đánh giá:
                           <div class="movie_choice">
                              <div id="rate_widget" style="cursor: pointer;">
                                 <div id="1_star" class="ratings_stars"><img src="{{URL::asset('images/star_empty.png')}}"/></div>
                                 <div id="2_star" class="ratings_stars"><img src="{{URL::asset('images/star_empty.png')}}"/></div>
                                 <div id="3_star" class="ratings_stars"><img src="{{URL::asset('images/star_empty.png')}}"/></div>
                                 <div id="4_star" class="ratings_stars"><img src="{{URL::asset('images/star_empty.png')}}"/></div>
                                 <div id="5_star" class="ratings_stars"><img src="{{URL::asset('images/star_empty.png')}}"/></div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="quantity">
               </div>
               <a style="text-decoration: none;" href="{{route('purchase',['id'=>$product->id, 'quantity'=> 1])}}" class="btn_purchase h3">
               MUA NGAY
               </a>
            </div>
         </div>
      </div>
   </div>
   <div id="prodetail">
      <div class="row">
         <article class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <p class="text-justify">{!!$product->description!!}</p>
            <div class="fb-comments" data-href="http://localhost:8080/final/san-pham/{{$product->unsigned_name}}" data-width="800" data-numposts="5"></div>
         </article>
         <aside class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <center>
               <h3 class="text-uppercase" style="font-style: italic;font-weight: bold;">Sản phẩm bán chạy</h3>
            </center>
            <div class="row">
               @foreach($relatedProducts as $relatedProduct)
                  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                     <div class="suggest_item text-center">
                        <a href="#">
                           <img src='{{URL::asset("images/$relatedProduct->path")}}' alt="{{$relatedProduct->name}}" height="250px">
                           <div class="item_title text-uppercase" style="width: 220px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$relatedProduct->name}}">{{$relatedProduct->name}}</div>
                        </a>
                        <div class="price">
                           @if($relatedProduct->promotion != 0)
                              <span class="old">{{number_format($relatedProduct->price)}}<sup>đ</sup></span>&nbsp;&nbsp;-&nbsp;&nbsp;
                              <span class="new">{{number_format($relatedProduct->promotion)}}<sup>đ</sup></span>
                           @else
                              <span class="new">{{number_format($relatedProduct->price)}}<sup>đ</sup></span>
                           @endif
                        </div>
                        <a href="{{route('product-detail',['name'=>$relatedProduct->unsigned_name])}}" class="mua_button_small">CHI TIẾT</a>
                  </div>
                  </div>
               @endforeach
            </div>
         </aside>
      </div>
   </div>
</div>
<script type="text/javascript">
   var data = {
      id: {{$product->id}},
      rate: {{round($product->vote / $product->view)}}
   }
   set_votes(data);
   $(".ratings_stars").hover(function(){
    $(this).prevAll().addBack().children("img").attr("src", "http://localhost:8080/final/images/star_highlight.png");
    $(this).nextAll().children("img").attr("src", "http://localhost:8080/final/images/star_empty.png");
  }, function(){
    $(this).prevAll().addBack().children("img").attr("src", "http://localhost:8080/final/images/star_empty.png");
    set_votes(data);
  });
  $('.ratings_stars').on('click', function(){
    var request = $.ajax({
      url: "{{route('updateVote')}}",
      method: "GET",
      data: {vote: parseInt($(this).attr("id")), id: data.id},
      dataType: "json"
    });
    request.done(function(data3){
      set_votes(data3);
      data = data3;
    });

  });

  function set_votes(data){
    $("#rate_widget").find('#' + data.rate + '_star').prevAll().addBack().children("img").attr("src", "http://localhost:8080/final/images/star_full.png");
    $("#rate_widget").find('#' + ( data.rate + 1 ) + '_star').nextAll().children("img").attr("src", "http://localhost:8080/final/images/star_empty.png");
  }
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=350177222049097";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
@endsection