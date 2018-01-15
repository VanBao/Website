@extends("index")
@section('title')
Liên hệ
@endsection
@section("content")
<div id="content">
   <ol class="breadcrumb">
      <li><a href="index.html">Trang chủ</a></li>
      <li class="active">liên hệ</li>
   </ol>
   <div class="row">
      <div class="col-md-8" id="contact-form">
         <h3>Bạn muốn liên hệ?</h3>
         <form class="form-horizontal" action="{{route('contact')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
               <label for="name" class="col-sm-2 control-label">Họ tên</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" required/>
               </div>
            </div>
            <div class="form-group">
               <label for="phonenumber" class="col-sm-2 control-label">Số ĐT</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="phonenumber" id="phonenumber" required>
               </div>
            </div>
            <div class="form-group">
               <label for="email" class="col-sm-2 control-label">Email</label>
               <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" id="email" required/>
               </div>
            </div>
            <div class="form-group">
               <label for="message" class="col-sm-2 control-label">Tin nhắn</label>
               <div class="col-sm-10">
                  <textarea style="resize: none;" id="message" class="form-control" name="message" rows="5" required></textarea>
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn-submit">Gửi</button>
               </div>
            </div>
         </form>
      </div>
      <div class="col-md-4" id="contact-infor">
         <h3>Thông tin</h3>
         <ul class="social ">
            <li><span>110 Đặng Văn Bi, Quận Thủ Đức, Hồ Chí Minh</span></li>
            <li><span>0972 263 932</span></li>
            <li><a href="mailto:vanbao2013@gmail.com">vanbao2013@gmail.com</a></li>
         </ul>
         <div id="map" style="width:100%;height:320px"></div>
         <script>
            function myMap() {
             var myCenter = new google.maps.LatLng(10.843913, 106.762491);
             var mapCanvas = document.getElementById("map");
             var mapOptions = {center: myCenter, zoom: 15};
             var map = new google.maps.Map(mapCanvas, mapOptions);
             var marker = new google.maps.Marker({position:myCenter});
             marker.setMap(map);
            }
         </script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn4xO-TZlD5quYdF8x5bW-BMPBUpxJ_Ns&callback=myMap"></script>
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
            @if(count($errors) > 0)
            <div class="alert alert-warning text-center">
               @foreach($errors->all() as $error)
                  <span class="h4">{{$error}}<span><br/>
               @endforeach
            </div>
            @else
            <div class="alert alert-success text-center">
               <span class="h4">{{session("message")}}<span><br/>
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
   @if(count($errors) > 0 or Session::exists("message"))
      $("#myModal").modal("show");
   @endif
</script>
@endsection