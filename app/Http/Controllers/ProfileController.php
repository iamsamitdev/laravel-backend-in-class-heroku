<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Image;

class ProfileController extends Controller
{

    public function uploadavatar(Request $request, $id)
    {
        // return response(['id'=>$id]);
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // รับภาพเข้ามา
        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();
        
        // สร้างภาพย่อ
        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['file']);

        // อัพโหลดภาพต้นฉบับ
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['file']);

        return response([
            'message'=>'Image has successfully uploaded.',
            'data' => $input['file']
        ], 201);
    }

}
