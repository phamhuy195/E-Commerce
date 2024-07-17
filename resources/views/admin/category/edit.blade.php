@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Category</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">

                                @csrf

                                @method('Put')
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <div>
                                        <button class="btn btn-primary" role="iconpicker" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" data-icon="{{ $category->icon }}" name="icon"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option  value="0" {{ $category->status == 0 ? 'selected' : '' }} >Active</option>
                                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }} >Inactive</option>
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
