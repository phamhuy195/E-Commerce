@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Sub Category</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Sub Category</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.sub-category.update', $subcategories->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select name="category_id" id="inputState" class="form-control">
                                        @foreach ($categories as $category)
                                        <option {{ $subcategories->category_id == $category->id ? 'selected' : '' }} 
                                             value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $subcategories->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="0" {{ $subcategories->status == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ $subcategories->status == 1 ? 'selected' : '' }}>Inactive</option>
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
