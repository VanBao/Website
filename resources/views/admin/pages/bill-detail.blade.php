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
                        <th>Tên SP</th>
                        <th>Số lượng</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($arrBillDetail as $billDetail)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$billDetail->Product->name}}</td>
                           <td>{{$billDetail->quantity}}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
   </div>
</div>
@endsection