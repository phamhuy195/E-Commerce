@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Product Variant Item</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Variant Item</h4>
                        </div>
                        <div class="card-body p-0">
                            {{-- {{ route('admin.products-variant-item.store') }} --}}
                            <form action="{{ route('admin.products-variant-item.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="">Variant Name</label>
                                    <input type="text" name="variant_name" readonly value="{{ $variant->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="product_variant_id" value="{{ $variant->id }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="price" value="" class="form-control">
                                </div>

                            

                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select name="is_default" id="inputState" class="form-control">
                                        <option value="" selected disabled>Select</option>
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

                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
