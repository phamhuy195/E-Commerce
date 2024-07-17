@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Product Variant</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Variant </h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.products-variant.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ request()->product }}" class="form-control">
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
