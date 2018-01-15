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
               <div class="table-responsive">
                  <table width="100%" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>STT</th>
                           <th>Họ tên</th>
                           <th>Số điện thoại</th>
                           <th>Email</th>
                           <th>Giới tính</th>
                           <th>Địa chỉ</th>
                           <th>Vai trò</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($staffs as $staff)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$staff->name}}</td>
                           <td>{{$staff->phone_number}}</td>
                           <td>{{$staff->email}}</td>
                           <td>
                              @if($staff->gender == 1)
                              {{"Nam"}}
                              @else
                              {{"Nữ"}}
                              @endif
                           </td>
                           <td>{{$staff->gender}}</td>
                           <td>
                              @if($staff->level == 2)
                              {{"Quản lý"}}
                              @else
                              {{"Nhân viên"}}
                              @endif
                           </td>
                           <td>
                              <a href="{{route('deleteStaff', ['id'=>$staff->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('privilege',['id'=>$staff->id])}}" class="label label-info">Phân quyền</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.table-responsive -->
               {{$staffs->links()}}
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
   </div>
</div>
@endsection