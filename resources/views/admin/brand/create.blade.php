@extends('admin.layouts.master')
@section('content')

    <section class="section">

        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Brand</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Logo</label>
                                    <input type="file" name="logo" value="{{ old('logo') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="...">
                                </div>
                               

                                <div class="form-group">
                                    <label for="inputState">Is Featured</label>
                                    <select name="is_featured" id="inputState" class="form-control">
                                      <option value="">Select</option>
                                      <option value="0">Yes</option>
                                      <option value="1">No</option>
                                    </select>
                                  </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                      <option value="">Select</option>
                                      <option value="0">Active</option>
                                      <option value="1">Inactive</option>
                                    </select>
                                  </div>

                                <button class="btn btn-primary ">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
