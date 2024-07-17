@extends('admin.layouts.master')
@section('content')
    <section class="section">

        <div class="section-header">
            <h1>Product Variant Item</h1>
        </div>


        <div class="mb-3">
            <a href="{{ route('admin.products-variant.index', ['productId' => $product->id]) }}"
                class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Product Variant Item : {{ $variant->name }}</h4>
                            <div class="card-header-action">
                            </div>
                            <div class="card-header-action">
                                <a href="{{ route('admin.products-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                                    {{-- request()->product : product_id từ index  --}} class="btn btn-primary">+ Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Product Variant</th>
                                        <th>Price</th>
                                        <th>Is Default</th>
                                        <th >Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($variantItems as $variantItem)
                                        <tr class="">
                                            <td>{{ $variantItem->id }}</td>
                                            <td>
                                                {{ $variantItem->name }}
                                            </td>
                                            <td>{{ $variantItem->productVariant->name }}</td>
                                            <td>{{ number_format($variantItem->price, 0, ',', '.') }} VND </td>
                                            <td>
                                                {!! $variantItem->is_default == 0
                                                    ? '<i class="badge badge-success">Yes</i>'
                                                    : '<i class="badge badge-danger">No</i>' !!}
                                            </td>
                                            {{-- <td>
                                                {!! $variantItem->status == 0
                                                    ? '<i class="badge badge-success">Active</i>'
                                                    : '<i class="badge badge-danger">Inactive</i>' !!}
                                            </td> --}}
                                            <td>
                                                @if ($variantItem->status == 0)
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $variantItem->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $variantItem->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>

                                            <td class="d-flex align-items-center mt-2">

                                                <form action="" class="mx-2">
                                                    <a href="{{ route('admin.products-variant-item.edit', $variantItem->id) }}"
                                                        class="btn btn-primary"><i class="far fa-edit"></i></a>
                                                </form>

                                                <form
                                                    action="{{ route('admin.products-variant-item.destroy', $variantItem->id) }}"
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
                    url: "{{ route('admin.products-variant-item.change-status') }}",
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
