@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>
        
        <div class="mb-3">
            <a  href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product : {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                                <form action="{{ route('admin.products-image-gallery.store') }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Image <code>( Max: 5 )</code></label>
                                        <input type="file" name="image[]" multiple class="form-control">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id" >
                                    </div>
                                    <button class="btn btn-primary">Upload</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Table</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($imageGalleries as $imageGallery)
                                        <tr class="">
                                            <td>{{ $imageGallery->id }}</td>
                                            <td class="p-1">
                                                <img alt="image" src="{{ asset($imageGallery->image) }}" width="200px">
                                            </td>

                                            <td class="d-flex align-items-center mt-2">
                                                
                                                <form action="{{ route('admin.products-image-gallery.destroy', $imageGallery->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete-item"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </form>

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
