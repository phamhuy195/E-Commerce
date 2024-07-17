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
                            <h4>Product Table</h4>
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
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        {{-- <th>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                    class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th> --}}
                                        <th>Id</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Sku</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Is Top</th>
                                        <th>Is Best</th>
                                        <th>Is Featured</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($products as $product)
                                        <tr class="">
                                            <td>{{ $product->id }}</td>
                                            <td class="p-1">
                                                <img alt="image" src="{{ asset($product->thumbnail) }}" width="200px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ number_format($product->price, 0, ',', '.') }} VND </td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>
                                                {!! $product->is_top == 0 ? '<i class="badge badge-success">Yes</i>' : '<i class="badge badge-danger">No</i>' !!}
                                            </td>
                                            <td>
                                                {!! $product->is_best == 0 ? '<i class="badge badge-success">Yes</i>' : '<i class="badge badge-danger">No</i>' !!}
                                            </td>
                                            <td>
                                                {!! $product->is_featured == 0
                                                    ? '<i class="badge badge-success">Yes</i>'
                                                    : '<i class="badge badge-danger">No</i>' !!}
                                            </td>
                                            <td>
                                                {!! $product->status == 0
                                                    ? '<i class="badge badge-success">Active</i>'
                                                    : '<i class="badge badge-danger">Inactive</i>' !!}
                                            </td>
                                            <td class="d-flex align-items-center mt-2">
                                                <form action="" class="mx-2">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="btn btn-primary"><i class="far fa-edit"></i></a>
                                                </form>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete-item"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </form>
                                                    <div class="dropdown dropleft d-inline ml-2">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('admin.products-image-gallery.index', ['productId' => $product->id]) }}"><i
                                                                    class="far fa-heart"></i>Image Gallery</a>
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('admin.products-variant.index', ['productId' => $product->id]) }}"><i
                                                                    class="far fa-file"></i> Variant</a>
                                                            <form action="{{ route('admin.products.delete-all', $product->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="dropdown-item has-icon delete-item" href="{{ route('admin.products.delete-all', $product->id) }}" ><i
                                                                        class="far fa-trash-alt"></i> Delete All</a>
                                                            </form>
                                                        </div>

                                                    </div>

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
