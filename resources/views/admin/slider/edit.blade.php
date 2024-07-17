@extends('admin.layouts.master')
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Slider</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="">Preview</label>
                                    <br>
                                    <img src="{{ asset($slider->banner) }}" width="200" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="text" name="type" value="{{ $slider->type }}" class="form-control" placeholder="Hot deal ...">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="{{ $slider->title }}" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="price" value="{{ $slider->price }}" class="form-control" placeholder="Enter Price">
                                </div>
                                <div class="form-group">
                                    <label for="">Button Url</label>
                                    <input type="text" name="btn_url" value="{{ $slider->btn_url }}" class="form-control" placeholder="Enter Url">
                                </div>
                                <div class="form-group">
                                    <label for="">Serial Number</label>
                                    <input type="text" name="serial" value="{{ $slider->serial }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                      <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Active</option>
                                      <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                  </div>

                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
