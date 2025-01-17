@extends('frontend.layouts.master')
@section('content')
    <!--============================
                    BREADCRUMB START
                ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="">flash sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                    BREADCRUMB END
                ==============================-->


    <!--============================
                    DAILY DEALS DETAILS START
                ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_2.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_3.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    @foreach ($productFlashSales as $productFlashSale)
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($productFlashSale->product->product_type) }} </span>
                                @if (checkDiscount($productFlashSale->product))
                                    <span
                                        class="wsus__minus">{{ discountPercent($productFlashSale->product->price, $productFlashSale->product->discount_price) }}</span>
                                @endif
                                <a class="wsus__pro_link" href="product_details.html">
                                    <img src="{{ $productFlashSale->product->thumbnail }} " alt="product"
                                        class="img-fluid w-100 img_1" />
                                    <img src="
                                @if (isset($productFlashSale->product->productImageGalleries[0]->image)) {{ asset($productFlashSale->product->productImageGalleries[1]->image) }}
                                @else
                                    {{ $productFlashSale->product->thumbnail }} @endif
                                "
                                        alt="product" class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category"
                                        href="#">{{ $productFlashSale->product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" href="#">{{ $productFlashSale->product->name }}</a>
                                    @if (checkDiscount($productFlashSale->product))
                                        <p class="wsus__price">{{ formatPrice($productFlashSale->product->discount_price) }}
                                            <del>{{ formatPrice($productFlashSale->product->price) }}</del></p>
                                    @else
                                        <p class="wsus__price">{{ formatPrice($productFlashSale->product->price) }}</p>
                                    @endif
                                    {{-- <p class="wsus__price">$159 <del>$200</del></p> --}}
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="mt-3 d-flex justify-content-center">
                    @if ($productFlashSales->hasPages())
                        {{ $productFlashSales->links() }}
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!--============================
                    DAILY DEALS DETAILS END
                ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //=======COUNTDOWN======   
            var d = new Date();
            console.log(d.getFullYear());
            console.log(d.getMonth());
            console.log(d.getDate());
            // default example
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
                enableUtc: true
            });
        })
    </script>
@endpush
