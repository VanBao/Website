@extends("index")
@section('title')
Giới thiệu
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="{{route('home')}}">Trang chủ</a></li>
      <li class="active">giới thiệu</li>
   </ol>
</div>
@endsection