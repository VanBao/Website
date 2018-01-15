<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Quản trị</title>
      <link rel="shortcut icon" type="image/png" href="{{asset('images/admin-icon.png')}}"/>
      <link rel="shortcut icon" type="image/jpg" href="{{asset('images/admin.jpg')}}"/>
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">
      <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
      <link href="{{asset('css/morris.css')}}" rel="stylesheet">
      <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet">
      <link href="{{asset('css/dataTables.responsive.css')}}" rel="stylesheet">
      <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/metisMenu.min.js')}}"></script>
      <script src="{{asset('js/raphael.min.js')}}"></script>
      <script src="{{asset('js/sb-admin-2.js')}}"></script>
      <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
      <script src="{{asset('js/dataTables.responsive.js')}}"></script>
      <script src="{{URL::asset('ckeditor/ckeditor.js')}}"></script>
      <script src="{{URL::asset('ckfinder/ckfinder.js')}}"></script>
   </head>
   <body>
      <div id="wrapper">
         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{route('adminHome')}}">Quản trị</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
               <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                     <li>
                        <a href="{{route('accountAdmin')}}"><i class="fa fa-user fa-fw"></i> Tài khoản</a>
                     </li>
                     <li>
                        <a href="{{route('changePasswordAdmin')}}"><i class="fa fa-key"></i> Đổi mật khẩu</a>
                     </li>
                     <li>
                        <a href="{{route('logoutAdmin')}}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                     </li>
                  </ul>
               </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
               <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                     <li>
                        <a href="{{route('adminHome')}}"><i class="fa fa-home""></i> Trang chủ</a>
                     </li>
                     <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Loại sản phẩm<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="{{route('categoryList')}}">Danh sách</a>
                           </li>
                           <li>
                              <a href="{{route('categoryAdding')}}">Thêm</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="{{route('productList')}}">Danh sách</a>
                           </li>
                           <li>
                              <a href="{{route('productAdding')}}">Thêm</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Slide<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="{{route('slideList')}}">Danh sách</a>
                           </li>
                           <li>
                              <a href="{{route('slideAdding')}}">Thêm</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="{{route('billList')}}"><i class="fa fa-sitemap fa-fw"></i> Đơn đặt hàng</a>
                     </li>
                     <li>
                        <a href="{{route('contactList')}}"><i class="fa fa-comment"></i> Tin nhắn</a>
                     </li>
                     @if(Auth::guard('admin')->user()->level == 2)
                        <li>
                           <a href="#"><i class="fa fa-wrench fa-fw"></i> Nhân viên<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                              <li>
                                 <a href="{{route('listStaff')}}">Danh sách</a>
                              </li>
                              <li>
                                 <a href="{{route('addStaff')}}">Thêm</a>
                              </li>
                           </ul>
                        </li>
                     @endif
                  </ul>
               </div>
            </div>
         </nav>
         @yield("content")
      </div>
   </body>
</html>