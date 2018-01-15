<header>
   <div id="top-header">
      <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            Hỗ trợ khách hàng: 0972 263 932
         </div>
         <div class="col-lg-2 col-lg-offset-6 col-md-3 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-12 text-center">
            <ul class="list-inline">
               @if(!Auth::check())
               <li><a href="{{route('login')}}">ĐĂNG NHẬP</a></li>
               <li><a href="{{route('register')}}">ĐĂNG KÝ</a></li>
               @else
               <li><a href="{{route('account')}}">{{Auth::user()->name}}</a></li>
               <li><a href="{{route('logout')}}">ĐĂNG XUẤT</a></li>
               @endif
            </ul>
         </div>
      </div>
   </div>
   <nav id="navigation" class="navbar navbar-default">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
         </div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               <li><a href="{{route('home')}}">Trang chủ <span class="sr-only">(current)</span></a></li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Loại bánh <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     @foreach($categories as $category)
                     <li><a class="h4" href="{{route('category',['name'=>$category->unsigned_name])}}">{{$category->name}}</a></li>
                     @endforeach
                  </ul>
               </li>
               <li><a href="{{route('contact')}}">Liên hệ</a></li>
               <li><a href="{{route('about')}}">Giới thiệu</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li title="{{session('cart')->getNumOfProduct()}} sản phẩm"><a href="{{route('cart')}}"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
            </ul>
            <form action="{{route('search')}}" method="GET" class="navbar-form navbar-right">
               <div class="form-group">
                  <input type="text" class="form-control" id="search" name="keyword" placeholder="Tìm kiếm..." required>
               </div>
               <button type="submit" class="btn btn-default">Tìm kiếm</button>
            </form>
         </div>
      </div>
   </nav>
</header>
