@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Child Category</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Sub Category</h4>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.child-category.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select name="category_id" id="inputState" class="form-control main-category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select name="sub_category_id" id="inputState" class="form-control sub-category">
                                        <option value="">Select</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="" class="form-control">
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


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                // alert('hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
