@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Child Category Table</h4>
                            {{-- <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}

                            <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary">+ Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @foreach ($childCategories as $childCategory)
                                        <tr class="justify-content-center">
                                            <td>{{ $childCategory->id }}</td>
                                            <td>{{ $childCategory->name }}</td>
                                            <td> {{ $childCategory->slug }} </td>
                                            <td> {{ $childCategory->category->name }} </td>
                                            <td> {{ $childCategory->subCategory->name }} </td>
                                            <td>
                                                {!! $childCategory->status == 0
                                                    ? '<i class="badge badge-success">Active</i>'
                                                    : '<i class="badge badge-danger">Inactive</i>' !!}

                                            </td>
                                            <td class="d-flex align-items-center mt-2">
                                                <form action="" class="mx-2">
                                                    <a href="{{ route('admin.child-category.edit', $childCategory->id) }}"
                                                        class="btn btn-primary"><i class="far fa-edit"></i></a>
                                                </form>
                                                
                                                <form action="{{ route('admin.child-category.destroy', $childCategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                    {{-- onclick="return confirm('Are you sure?')" --}}
                                                        class="btn btn-danger delete-item"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                                {{-- <a href="{{ route('admin.child-category.destroy', $childCategory->id) }}"
                                                    class="btn btn-danger delete-item"><i class="far fa-trash-alt"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
