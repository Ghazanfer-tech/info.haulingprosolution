@extends('web.master')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <!-- <ol class="breadcrumb justify-content-center mb-0"> -->
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                    <li class="breadcrumb-item active text-white">Cart</li> -->
        <!-- </ol> -->
    </div>
    <!-- Single Page Header End -->

    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: '{{ Session::get('success') }}',
                icon: 'success',
                timer: 5000,
            })
        </script>
    @endif

    <!-- Cart Page Start -->
    @php $sub_total = 0 @endphp

    @foreach ((array) session('cart') as $id => $details)
        @php
            $sub_total += $details['price'] * $details['quantity'];
        @endphp
    @endforeach
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <!-- <img src="{{ asset('/fruitables/img/vegetable-item-3.png') }}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""> -->
                                            <img src="{{ asset('uploads/products/' . $details['image']) }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <!-- <p class="mb-0 mt-4">Big Banana</p> -->
                                        <p class="mb-0 mt-4">{{ $details['name'] }}</p>
                                    </td>
                                    <td>
                                        <!-- <p class="mb-0 mt-4">2.99 $</p> -->
                                        <p class="mb-0 mt-4">{{ $details['price'] }}</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button onclick="decrementQuantity({{ $id }})"
                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <!-- <input type="text" class="form-control form-control-sm text-center border-0" value="1"> -->
                                            <input disabled id="cart-item-{{ $id }}" type="text"
                                                class="form-control form-control-sm text-center border-0"
                                                value="{{ $details['quantity'] }}">

                                            <form id="cart-form-update-{{ $id }}"
                                                action="{{ route('web-update-cart') }}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <!-- <input type="hidden" name="_method" value="PATCH"> -->
                                                <!-- @method('put') -->
                                                <input type="hidden" name="quantity">
                                                <input type="hidden" name="id" value="{{ $id }}">
                                            </form>

                                            <div class="input-group-btn">
                                                <button onclick="incrementQuantity({{ $id }})"
                                                    class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <p class="mb-0 mt-4">2.99 $</p> -->
                                        <p class="mb-0 mt-4">{{ $details['price'] * $details['quantity'] }}</p>
                                    </td>
                                    <td>
                                        <button onclick="removeFromCart({{ $id }})"
                                            class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                        <form id="cart-item-form-{{ $id }}"
                                            action="{{ route('web-remove-from-cart') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        <!-- <tr>
                                                                    <th scope="row">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ asset('/fruitables/img/vegetable-item-5.jpg') }}"
                                                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""
                                                                                alt="">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">Potatoes</p>
                                                                    </td>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">2.99 $</p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                                                            <div class="input-group-btn">
                                                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                                    <i class="fa fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                            <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                                            <div class="input-group-btn">
                                                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">2.99 $</p>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-md rounded-circle bg-light border mt-4">
                                                                            <i class="fa fa-times text-danger"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ asset('/fruitables/img/vegetable-item-2.jpg') }}"
                                                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""
                                                                                alt="">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">Awesome Brocoli</p>
                                                                    </td>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">2.99 $</p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                                                            <div class="input-group-btn">
                                                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                                    <i class="fa fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                            <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                                            <div class="input-group-btn">
                                                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <p class="mb-0 mt-4">2.99 $</p>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-md rounded-circle bg-light border mt-4">
                                                                            <i class="fa fa-times text-danger"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{-- <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code"> --}}
                {{-- <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply --}}
                    {{-- Coupon</button> --}}
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <!-- <p class="mb-0">$96.00</p> -->
                                <p class="mb-0">{{ $sub_total }}</p>
                            </div>
                            <!-- <div class="d-flex justify-content-between"> -->
                            <!-- <h5 class="mb-0 me-4">Shipping</h5> -->
                            <!-- <div class=""> -->
                            <!-- <p class="mb-0">Flat rate: $3.00</p> -->
                            <!-- </div> -->
                        </div>
                        <!-- <p class="mb-0 text-end">Shipping to Ukraine.</p> -->
                    </div>
                    <!-- <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between"> -->
                    <!-- <h5 class="mb-0 ps-4 me-4">Total</h5> -->
                    <!-- <p class="mb-0 pe-4">$99.00</p> -->
                </div>
                <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                    type="button" href= "{{ route('web-checkout') }}"> Proceed Checkout </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Cart Page End -->

    <script>
        function removeFromCart(id) {
            if (confirm("Are you sure you want to remove product from cart?")) {
                document.getElementById('cart-item-form-' + id).submit();
            }
        }

        function decrementQuantity(id) {
            quantity = --document.getElementById('cart-item-' + id).value;
            if (quantity == 0) {
                alert('There must be at least one quantity');
                return;
            }
            form = document.getElementById('cart-form-update-' + id);
            form.quantity.value = quantity;
            form.submit();
        }

        function incrementQuantity(id) {
            quantity = ++document.getElementById('cart-item-' + id).value;
            form = document.getElementById('cart-form-update-' + id);
            form.quantity.value = quantity;
            form.submit();
        }
    </script>
@endsection
