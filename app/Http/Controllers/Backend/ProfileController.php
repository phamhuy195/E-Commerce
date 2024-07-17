<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;


class ProfileController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        return view('admin.profile.index');
    }
    public function updateProfile(Request $request)
    {
        // $request ->validate([
        //     'name' => ['required','max:100'],
        //     'email' => ['required', 'email' ,'unique:users,email,'. Auth::user()->id ],
        //     ]);

        // $user = Auth::user(); // Lấy người dùng hiện tại

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();

        // Cách 2 
        $data = $request->validate(
            [
                'name' => ['required', 'max:100'],
                'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
                'image' =>['image','mimes:png,jpg,jpeg','max:2048']
            ],
            [
                'email.unique' => 'Email đã tồn tại',
                'image.image' => 'Định dạng hình ảnh không hợp lệ',
                'image.mimes' => 'Định dạng hình ảnh không hợp lệ'
            ]
        );

        // $user =  Auth::user();

        // if($request->hasFile('image')){
        //     // Xóa file ảnh :

        //     if(File::exists(public_path(Auth::user()->image))){
        //         File::delete(public_path(Auth::user()->image));
        //     }

        //     $image = $request->image;
            
        //     $imageName = rand().'_'.$image->getClientOriginalName();
        //     $image->move(public_path('uploads'),$imageName);

        //     $path = "/uploads/".$imageName;

        //     // $user->image = $path;
        //     Auth::user()->image = $path;
        // }

        // // $user->update($data);
        // Auth::user()->update($data);

        $user  = Auth::user();

        $imagePath = $this->updateImage($request, 'image', '/uploads', $user->image);
        $user->image = $imagePath;

        $user->update($data);

        toastr()->success('Profile updated successfully!');
        return redirect()->back();


    }
    /*   Update Password */
    public function updatePassword(Request $request){
        // dd($request->all());

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed','min:8'],
        ]);
        $request->user()->update([
            'password' =>bcrypt($request->password)
        ]);
        toastr()->success('Profile password updated successfully!');
        return redirect()->back();
    }
}
