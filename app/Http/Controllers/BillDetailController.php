<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillDetail;

class BillDetailController extends Controller
{
    public function detail($id)
    {
    	$arrBillDetail = BillDetail::where("bill_id", $id)->get();
    	return view("admin.pages.bill-detail",["arrBillDetail"=>$arrBillDetail]);
    }
}
