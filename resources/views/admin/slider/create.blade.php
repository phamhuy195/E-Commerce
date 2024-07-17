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
                            <h4>Create Slider</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Banner</label>
                                    <input type="file" name="banner" value="{{ old('banner') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="text" name="type" value="{{ old('type') }}" class="form-control" placeholder="Hot deal ...">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="Enter Price">
                                </div>
                                <div class="form-group">
                                    <label for="">Button Url</label>
                                    <input type="text" name="btn_url" value="{{ old('btn_url') }}" class="form-control" placeholder="Enter Url">
                                </div>
                                <div class="form-group">
                                    <label for="">Serial Number</label>
                                    <input type="text" name="serial" value="{{ old('serial') }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                      <option value="0">Active</option>
                                      <option value="1">Inactive</option>
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
