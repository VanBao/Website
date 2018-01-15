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
               <table width="100%" class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số ĐT</th>
                        <th>Tin nhắn</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($arrContact as $contact)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$contact->name}}</td>
                           <td>{{$contact->email}}</td>
                           <td>{{$contact->phone_number}}</td>
                           <td>{{$contact->message}}</td>
                           <td>
                              @if($contact->status == 1)
                                 {{"Đã trả lời"}}
                              @else
                                 {{"Chưa trả lời"}}
                              @endif
                           </td>
                           <td>
                              <a href="{{route('contactDeleting',['id'=>$contact->id])}}" class="label label-danger" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a>&nbsp;&nbsp;&nbsp;
                              <a href="{{route('answer',['id'=>$contact->id])}}" class="label label-info">Trả lời</a>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               <!-- /.table-responsive -->
               {{$arrContact->links()}}
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
   </div>
</div>
@endsection