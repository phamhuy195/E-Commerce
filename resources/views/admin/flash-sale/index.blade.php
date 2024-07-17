@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Flash Sale</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale End Date</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="form-group">
                                        <label>Sale End Date</label>
                                        <input type="text" class="form-control datepicker" name="end_date"
                                            value="{{ @$flashSaleDate->end_date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label>Add Product</label>
                                    <select name="product_id" id="" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Show at home?</label>
                                            <select name="show_at_home" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="0">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="0">Active</option>
                                                <option value="1">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale Products</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">+ Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Show At Home</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    @foreach ($flashSaleProducts as $flashSaleProduct)
                                        <tr class="justify-content-center">
                                            <td>{{ $flashSaleProduct->id }}</td>

                                            <td><a href="{{ route('admin.products.edit', $flashSaleProduct->product->id) }}">{{ $flashSaleProduct->product->name }}</a></td>

                                            <td>
                                                @if ($flashSaleProduct->show_at_home == 0)
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $flashSaleProduct->id }}"
                                                            class="custom-switch-input show-at-home">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $flashSaleProduct->id }}"
                                                            class="custom-switch-input show-at-home">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($flashSaleProduct->status == 0)
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $flashSaleProduct->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $flashSaleProduct->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>


                                            <td class="d-flex align-items-center mt-2">
                                                <form
                                                    action="{{ route('admin.flash-sale.destroy', $flashSaleProduct->id) }}"
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

@push('scripts')
    {{-- Change Status  --}}

    <script>
        $(document).ready(function() {
            // Khi tài liệu (DOM) đã được tải hoàn toàn và sẵn sàng, thực thi đoạn mã bên trong hàm này
            $('body').on('click', '.change-status', function() {
                // Gán giá trị của checkbox đang được click vào biến isChecked
                let isChecked = $(this).is(':checked');
                // Lấy giá trị data-id từ thuộc tính data-id của checkbox đang được click
                let id = $(this).data('id');
                // Ghi ra console giá trị của isChecked và id để kiểm tra
                console.log(isChecked, id);

                // Thực hiện yêu cầu AJAX tới server
                $.ajax({
                    // Đặt URL mà yêu cầu sẽ được gửi tới, sử dụng route đã được định nghĩa trong Laravel
                    url: "{{ route('admin.flash-sale.change-status') }}",
                    // Đặt phương thức HTTP của yêu cầu là PUT
                    method: 'PUT',
                    // Thiết lập dữ liệu sẽ được gửi tới server, bao gồm trạng thái và ID của sản phẩm
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    // Hàm sẽ được thực thi nếu yêu cầu thành công
                    success: function(data) {
                        // Tải lại trang web sau khi cập nhật thành công
                        window.location.reload();
                    },
                    // Hàm sẽ được thực thi nếu yêu cầu gặp lỗi
                    error: function(xhr, status, error) {
                        // Ghi lỗi ra console để kiểm tra và xử lý
                        console.log(error);
                    }
                });
            });
        });
    </script>


    {{-- Show at home  --}}
    <script>
        $(document).ready(function() {
            // Khi tài liệu (DOM) đã được tải hoàn toàn và sẵn sàng, thực thi đoạn mã bên trong hàm này
            $('body').on('click', '.show-at-home', function() {
                // Gán giá trị của checkbox đang được click vào biến isChecked
                let isChecked = $(this).is(':checked');
                // Lấy giá trị data-id từ thuộc tính data-id của checkbox đang được click
                let id = $(this).data('id');
                // Ghi ra console giá trị của isChecked và id để kiểm tra
                console.log(isChecked, id);

                // Thực hiện yêu cầu AJAX tới server
                $.ajax({
                    // Đặt URL mà yêu cầu sẽ được gửi tới, sử dụng route đã được định nghĩa trong Laravel
                    url: "{{ route('admin.flash-sale.show-at-home') }}",
                    // Đặt phương thức HTTP của yêu cầu là PUT
                    method: 'PUT',
                    // Thiết lập dữ liệu sẽ được gửi tới server, bao gồm trạng thái và ID của sản phẩm
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    // Hàm sẽ được thực thi nếu yêu cầu thành công
                    success: function(data) {
                        // Tải lại trang web sau khi cập nhật thành công
                        window.location.reload();
                    },
                    // Hàm sẽ được thực thi nếu yêu cầu gặp lỗi
                    error: function(xhr, status, error) {
                        // Ghi lỗi ra console để kiểm tra và xử lý
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
