<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Barryvdh\DomPDF\Facade as PDF;

class BillController extends Controller
{
    public function index()
    {
    	$arrBill = Bill::paginate(10);
    	return view("admin.pages.bill-list", ["arrBill"=>$arrBill]);
    }

    public function toPDF($id)
    {
    	$bill = Bill::findOrFail($id);
    	$pdf = PDF::loadView("pdf.bill", ["bill"=>$bill]);
        return $pdf->stream();
    }
    public function showUnprocessedList()
    {
        $arrBill = Bill::where('status', 0)->paginate(10);
        return view("admin.pages.bill-list", ["arrBill"=>$arrBill]);
    }
    public function answer($id)
    {
        $contact = Contact::findOrFail(intval($request->input('id')));

        Mail::send('admin.email', ['contact'=>$contact, 'answer'=>$request->input('message')], function ($message) use ($contact) {


            $message->to($contact->email);

            $message->subject("Trả lời thắc mắc");

        });

        Session::flash("messageSuccess","Thành công.");

        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $bill = Bill::findOrFail(intval($request->input("id")));
        if($bill->status == 1)
        {
            $bill->status = 0;
        }
        else{
            $bill->status = 1;
        }
        $bill->save();
        return response()->json(['status'=>$bill->status]);
    }
}
