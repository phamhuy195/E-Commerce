<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'max:255'],
            'price' => ['max:255'],
            'btn_url' => ['url'],
            'serial' => ['integer', 'required'],
            'status' => ['required'],
        ],
        [
            'banner.required' => 'Vui lòng ...',
        ]
    );
        $slider = new Slider();

        // Handle file upload Traits 
        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->price = $request->price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        flash()->addFlash('success','Cập nhật slider thành công','Congratulations!');
        return redirect()->route('admin.slider.index');

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $data = $request->validate([
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'max:255'],
            'price' => ['max:255'],
            'btn_url' => ['url'],
            'serial' => ['integer', 'required'],
            'status' => ['required'],
        ]);

        $slider = Slider::findOrFail($id);

        // Handle file upload Traits 
        $imagePath = $this->updateImage($request, 'banner', 'uploads', $slider->banner);

        $slider->banner = $imagePath;

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->price = $request->price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        // $slider->update($data);
        $slider->save();

        flash()->addFlash('success','Cập nhật slider thành công','Congratulations!');
        // return 'hi';
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        // flash()->addFlash('success', 'Delete successfully', 'Success');
        
    }
}
