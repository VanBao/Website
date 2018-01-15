<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Session;
use Mail;
class ContactController extends Controller
{
    public function save(Request $request)
    {
    	$this->validate($request,
    		[
    			'phonenumber'=>'digits_between: 10,11'
    		],
    		[
    			'phonenumber.digits_between' =>'Số điện thoại không hợp lệ'
    		]);
    	$contact = new Contact;
    	$contact->name = $request->input("name");
    	$contact->email = $request->input("email");
    	$contact->phone_number = $request->input("phonenumber");
    	$contact->message = $request->input("message");
    	$contact->save();
    	Session::flash("message", "Bạn đã gửi tin nhắn thành công. Chúng tôi sẽ trả lời tin nhắn trong thời gian sớm nhất");
    	return redirect()->route("contact");
    }
    public function index()
    {
        $arrContact = Contact::paginate(10);
        return view('admin.pages.contact-list',['arrContact' => $arrContact]);
    }
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contactList');
    }
    public function showAnswerForm($id)
    {
        return view("admin.pages.answer", ["id"=>$id]);
    }
    public function answer(Request $request)
    {
        $contact = Contact::findOrFail(intval($request->input('id')));
        $contact->status = 1;
        $contact->save();
        Mail::send('email.response', ['contact'=>$contact, 'answer'=>$request->input('message')], function ($message) use ($contact) {
            $message->to($contact->email);

            $message->subject("Trả lời thắc mắc");

        });

        Session::flash("messageSuccess","Trả lời thành công.");

        return redirect()->back();
    }
    public function showUnreadList()
    {
        $arrContact = Contact::where('status', 0)->paginate(10);
        return view('admin.pages.contact-list',['arrContact' => $arrContact]);
    }
}
