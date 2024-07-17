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
                            <h4>Update Variant Item</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.products-variant-item.update',$variantItem->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Variant Name</label>
                                    <input type="text" name="variant_name" readonly value="{{ $variantItem->productVariant->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" name="name" value="{{ $variantItem->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="price" value="{{ $variantItem->price }}" class="form-control">
                                </div>

                            

                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select name="is_default" id="inputState" class="form-control">
                                        <option value="" selected disabled>Select</option>
                                        <option {{ $variantItem->is_default == 0 ? 'selected' : '' }}  value="0">Yes</option>
                                        <option {{ $variantItem->is_default == 1 ? 'selected' : '' }}  value="1">No</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ $variantItem->status == 0 ? 'selected' : '' }}  value="0">Active</option>
                                        <option {{ $variantItem->status == 1 ? 'selected' : '' }}  value="1">Inactive</option>
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
