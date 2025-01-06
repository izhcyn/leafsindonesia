@extends('layouts.app')



@section('content')
    <div class="container p-0" style="margin-top: 100px">

        <div class="row">
            <div class="col-2 pt-3">
                <a href="{{ route('allproducts') }}">
                    <button class="btn py-1 px-4 text-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg> <span> Back </span></button>
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card border-none">
                    <img src="{{ asset('storage/' . $produk->image) }}" class="card-img img-fluid"
                        style="height: 24.5em; object-fit: cover;">
                </div>

                <div class="row pt-3 d-flex align-items-start">
                    <div class="col"> <img src="{{ asset('storage/' . $produk->image_2) }}" class="card-img img-fluid"
                            style="height: 10.5em; object-fit: cover;"></div>
                    <div class="col"><img src="{{ asset('storage/' . $produk->image_3) }}" class="card-img img-fluid"
                            style="height: 10.5em; object-fit: cover;"></div>
                </div>
            </div>

            <div class="col-md-6">
                <p class="pt-3"> {{ $produk->genus }} </p>
                <h3 class="fw-bold"> {{ $produk->nama }} </h3>
                <hr>
                <p> Price:</p>
                <h2 class="fw-bold"> ${{ number_format($produk->price, 2) }} </h2>
                <p> Size : </p>
                <div class="btn btn-warning text-dark">{{ $produk->ukuran }}</div>
                <hr>

                <div class="row mt-3 ">
                    <div class="col-2">
                        <a class="btn w-100" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="#000000" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                <path
                                    d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                            </svg></a>
                    </div>
                    <div class="col ">
                        <div class="col">
                            @auth
                                <a href="{{ route('add.to.cart', $produk->id) }}" class="btn w-100 text-dark btn-add-to-cart"
                                    role="button">
                                    Add To Cart
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn w-100 text-dark btn-add-to-cart">Add to Cart</a>
                            @endauth


                        </div>

                    </div>
                    <div class="col ">
                        <a class="btn w-100 " style="background-color: orange" href=""> Buy Now</a>
                    </div>
                </div>
                <h3 class="py-3"> Description </h3>
                <p class="text-muted"> {{ $produk->deskripsi }} </p>
            </div>
        </div>
    </div>
    <hr class="my-5">
    </div>
@endsection

<script>
    $(document).ready(function() {
        const min = 1; // Minimum value
        const max = 10; // Maximum value

        $('#decrease').click(function() {
            let current = parseInt($('#quantity').val());
            if (current > min) {
                $('#quantity').val(current - 1);
            }
        });

        $('#increase').click(function() {
            let current = parseInt($('#quantity').val());
            if (current < max) {
                $('#quantity').val(current + 1);
            }
        });
    });
</script>
