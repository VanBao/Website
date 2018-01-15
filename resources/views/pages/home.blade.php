@extends("index") @section('title') Trang chủ @endsection @section("content")
<div id="content">
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=373411079772846';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="row" id="top">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    @foreach($slides as $slide)
                    <div class="mySlides fade1">
                        <img src='{{URL::asset("images/$slide->path")}}' class="img-responsive" style="width: 100%;" alt="{{$slide->name}}" />
                    </div>
                    @endforeach
                </div>
                <script>
                    var slideIndex = 0;
                    showSlides();

                    function showSlides() {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {
                            slideIndex = 1
                        }
                        slides[slideIndex - 1].style.display = "block";
                        setTimeout(showSlides, 3500);
                    }
                </script>
            </div>
            <div class="products">
                <h3>khuyến mãi</h3>
                <div class="row" id="products1">
                    @foreach($promotions as $promotion)
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail product">
                            <img src='{{URL::asset("images/$promotion->path")}}' width="100%" class="img-responsive img" alt="{{$promotion->name}}" />
                            <div class="product-infor">
                                <div class="pull-left" style="width: 100px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$promotion->name}}">{{$promotion->name}}</div>
                                <div class="pull-right">
                                    {{number_format($promotion->price)}}<sup>đ</sup>&nbsp;&nbsp;<span class="label label-danger" style="font-size: 14px;">-{{(($promotion->price - $promotion->promotion) / $promotion->price)*100}}%</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="middle">
                                <a class="text" href="{{route('product-detail',['name'=>$promotion->unsigned_name])}}">Xem</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="1">{{$promotions->links()}}</div>
            </div>
            <div class="products">
                <h3>nổi bật</h3>
                <div class="row" id="products2">
                    @foreach($featuredProducts as $featuredProduct)
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail product">
                            <img src='{{URL::asset("images/$featuredProduct->path")}}' width="100%" class="img-responsive img" alt="{{$featuredProduct->name}}" />
                            <div class="product-infor">
                                <div class="pull-left" style="width: 100px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$featuredProduct->name}}">{{$featuredProduct->name}}</div>
                                <div class="pull-right">
                                    {{number_format($featuredProduct->price)}}<sup>đ</sup> @if($featuredProduct->promotion != 0) &nbsp;&nbsp;
                                    <span class="label label-danger" style="font-size: 14px;">-{{(($featuredProduct->price - $featuredProduct->promotion) / $featuredProduct->price)*100}}%</span> @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="middle">
                                <a class="text" href="{{route('product-detail',['name'=>$featuredProduct->unsigned_name])}}">Xem</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="2">{{$featuredProducts->links()}}</div>
            </div>
            <div class="products">
                <h3>bán chạy</h3>
                <div class="row" id="products3">
                    @foreach($bestSellers as $bestSeller)
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail product">
                            <img src='{{URL::asset("images/$bestSeller->path")}}' width="100%" class="img-responsive img" alt="{{$bestSeller->name}}" />
                            <div class="product-infor">
                                <div class="pull-left" style="width: 100px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;" title="{{$bestSeller->name}}">{{$bestSeller->name}}</div>
                                <div class="pull-right">
                                    {{number_format($bestSeller->price)}}<sup>đ</sup> @if($bestSeller->promotion != 0) &nbsp;&nbsp;
                                    <span class="label label-danger" style="font-size: 14px;">-{{(($bestSeller->price - $bestSeller->promotion) / $bestSeller->price)*100}}%</span> @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="middle">
                                <a class="text" href="{{route('product-detail',['name'=>$bestSeller->unsigned_name])}}">Xem</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="3">{{$bestSellers->links()}}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-10 sort" style="padding-left: 0">
            <div class="fb-page" data-href="https://www.facebook.com/Si%C3%AAu-th%E1%BB%8B-b%C3%A1nh-B%E1%BA%A3o-L%C3%AA-672894559569475/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/sieuthicobap.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sieuthicobap.vn/">Siêu Thị Cơ Bắp - Energy</a></blockquote>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".pagination li:first-child").remove();
        $(".pagination li:first-child").remove();
        $(".pagination li:last-child").remove();
        $(".pagination li:last-child").remove();
        $(".pagination").prepend("<li><a href='javascript:void(0)'>1</a></li>")
        $(".pagination li a").attr("href", "javascript:void(0)");
        $(".pagination li:first-child").addClass("active");
        $(".pagination li a").click(function(event) {
            event.preventDefault();
            var arrLi = $($(this).parents("div")).find("li");
            for (var i = 0; i < arrLi.length; i++) {
                $(arrLi[i]).removeClass("active");
            }
            $($(this).parents("li")).addClass("active");
            var type = parseInt($($(this).parents("div")).attr("id"));
            var currentPage = parseInt($(this).text());
            var request = $.ajax({
                url: "{{URL::to('/')}}/" + type + "/" + currentPage,
                method: "GET",
                dataType: "html"
            });
            switch (type) {
                case 1:
                    request.done(function(data) {
                        $("#products1").html(data);
                    });
                    break;
                case 2:
                    request.done(function(data) {
                        $("#products2").html(data);
                    });
                    break;
                case 3:
                    request.done(function(data) {
                        $("#products3").html(data);
                    });
                    break;
            }
        });
    });
</script>
@endsection