<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
// use File;

class UserProfileController extends Controller
{
    public function index(){
        
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(request $request){

        // dd($request->all());
        $data = $request->validate(
            [
                'name' => ['required', 'max:100'],
                'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
                'image' =>['image','mimes:png,jpg,jpeg','max:2048']
            ],
            [
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng định dạng',
                'image.image' => 'Định dạng hình ảnh không hợp lệ',
                'image.mimes' => 'Định dạng hình ảnh không hợp lệ'
            ]
        );

        // $user =  Auth::user();

        if($request->hasFile('image')){
            // Xóa file ảnh :

            if(File::exists(public_path(Auth::user()->image))){
                File::delete(public_path(Auth::user()->image));
            }

            $image = $request->image;
            
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$imageName);

            $path = "/uploads/".$imageName;

            // $user->image = $path;
            Auth::user()->image = $path;
        }

        // $user->update($data);
        Auth::user()->update($data);

        flash()->addFlash('success','Cập nhật profile thành công','Congratulations!');
        return redirect()->back();
    }

    public function updatePassword(request $request){
        // dd($request->all());
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed','min:8'],
        ]);
        $request->user()->update([
            'password' =>bcrypt($request->password)
        ]);
        flash()->addFlash('success','Cập nhật password thành công','Congratulations!');
        return redirect()->back();
    }
}
