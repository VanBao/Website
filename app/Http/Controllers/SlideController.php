<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function index()
    {
    	$arrSlide = Slide::paginate(10);
    	return view("admin.pages.slide-list",["arrSlide"=>$arrSlide]);
    }
    public function delete($id)
    {
    	$slide = Slide::findOrFail($id);
        unlink("images/".$slide->path);
    	$slide->delete();
    	return redirect()->route('slideList');
    }
    public function edit($id)
    {
    	$slide = Slide::findOrFail($id);
    	return view("admin.pages.slide-edit",["slide"=>$slide]);
    }
    public function update(Request $request)
    {
        $slide = Slide::findOrFail(intval($request->input("id")));
        if(strcmp($slide->name, $request->input("name")) != 0)
        {
            $this->validate($request,[
                'name'=>'unique:slide,name',
                'image'=>'mimes:jpeg,jpg,png,gif'
                ],[
                'name.unique'=>'Tên slide đã tồn tại',
                'image.mimes'=>'File ảnh không hợp lệ'
            ]);
        }
        else if(!is_null($request->file('photo')))
        {
            $this->validate($request,[
                'image'=>'mimes:jpeg,jpg,png,gif'
                ],[
                'image.mimes'=>'File ảnh không hợp lệ'
            ]);
        }
        if(!is_null($request->file("image")))
        {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while(file_exists("images/".$fileName))
            {
                $fileName = date("YmdHis").$fileName;
            }
            unlink("images/".$slide->path);
            $slide->path = $fileName;
            $file->move("images",$fileName);
        }
        $slide->name = $request->input('name');
        $slide->save();
        return redirect()->route('slideList');
    }
    public function create()
    {
        return view("admin.pages.slide-adding");
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'unique:slide,name',
            'image'=>'mimes:jpeg,jpg,png,gif'
            ],[
            'name.unique'=>'Tên slide đã tồn tại',
            'image.mimes'=>'File ảnh không hợp lệ'
        ]);
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        while(file_exists("images/".$fileName)){
            $fileName = date("YmdHis").$fileName;
        }
        $file->move("images",$fileName);
        $slide = new Slide;
        $slide->name = $request->input('name');
        $slide->path = $fileName;
        $slide->save();
        return redirect()->route('slideList');
    }
    public function updateStatus(Request $request)
    {
        $slide = Slide::findOrFail(intval($request->input("id")));
        if($slide->status == 1)
        {
            $slide->status = 0;
        }
        else{
            $slide->status = 1;
        }
        $slide->save();
        return response()->json(['status'=>$slide->status]);
    }
}
