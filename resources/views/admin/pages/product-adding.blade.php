@extends("admin.index")
@section("content")
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
          <form class="form-horizontal" action="{{route('productAdding')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Tên</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Tên sản phẩm" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="category" class="col-sm-2 control-label">Loại sản phẩm</label>
              <div class="col-sm-10">
                <select class="form-control" name="category" id="category">
                  @foreach($arrCategory as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-sm-2 control-label">Mô tả</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="description" id="description" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="price" class="col-sm-2 control-label">Giá</label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="price" id="price" placeholder="Giá" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="promotion" class="col-sm-2 control-label">Giá KM</label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="promotion" id="promotion" placeholder="Giá khuyến mãi" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="origin" class="col-sm-2 control-label">Nguồn gốc</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="origin" id="origin" placeholder="Nguồn gốc" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="expiry_date" class="col-sm-2 control-label">Hạn sử dụng</label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="expiry_date" id="expiry_date" placeholder="Hạn sử dụng" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="weight" class="col-sm-2 control-label">Khối lượng</label>
              <div class="col-sm-10">
                <input type="number" class="form-control number" name="weight" id="weight" placeholder="Khối lượng" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="image" class="col-sm-2 control-label">Hình ảnh</label>
              <div class="col-sm-10">
                <img id="image" class="img-responsive" width="60%" style="margin-bottom: 5px;"/>
                <input type="file" class="form-control" name="image" onchange="openFile(event)" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Thêm</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
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
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  @if(count($errors) > 0)
  $("#myModal").modal("show");
  @endif
  $(document).ready(function(){
    $("#image").hide();
    CKEDITOR.replace( 'description',
    {
      filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Files') }}",
      filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Images') }}",
      filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?Type=Flash') }}",
      filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
      filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connctor/php/connector.php?command=QuickUpload&type=Images') }}",
      filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
    });
    $(".number").keypress(function (evt) {
      if($(this).val() < 1){
        evt.preventDefault();
        $(this).val(1);
      }
    });
  });
  var openFile = function(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = $('#image');
      output.attr("src", dataURL);
      output.show();
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>
@endsection
