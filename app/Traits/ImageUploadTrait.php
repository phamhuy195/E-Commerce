<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

trait ImageUploadTrait{

    public function uploadImage(Request $request, $inputName, $path){
        if($request->hasFile($inputName)){

            $image = $request->{$inputName};

            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }
    public function updateImage(Request $request, $inputName, $path , $oldpath ){
        if($request->hasFile($inputName)){

            if(File::exists(public_path($oldpath))){
                File::delete(public_path($oldpath));
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;
            
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
        return $oldpath;
    }

    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        // Khởi tạo một mảng trống để lưu trữ các đường dẫn của hình ảnh sau khi tải lên
        $imagePaths = [];
        
        // Kiểm tra xem yêu cầu có tệp tin với tên $inputName hay không
        if($request->hasFile($inputName)) {
    
            // Lấy mảng các tệp tin hình ảnh từ yêu cầu
            $images = $request->{$inputName};
    
            // Lặp qua từng tệp tin trong mảng $images
            foreach($images as $image) {
    
                // Lấy phần mở rộng của tệp tin (ví dụ: jpeg, png, v.v.)
                $ext = $image->getClientOriginalExtension();
    
                // Tạo tên tệp tin duy nhất bằng cách sử dụng hàm uniqid và thêm phần mở rộng
                $imageName = 'media_' . uniqid() . '.' . $ext;
    
                // Di chuyển tệp tin đến thư mục xác định và lưu trữ tệp tin với tên mới
                $image->move(public_path($path), $imageName);
    
                // Thêm đường dẫn của tệp tin mới vào mảng $imagePaths
                $imagePaths[] =  $path . '/' . $imageName;
            }
        }
    
        // Trả về mảng các đường dẫn của hình ảnh đã tải lên
        return $imagePaths;
    }
    

    public function deleteImage(string $path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}