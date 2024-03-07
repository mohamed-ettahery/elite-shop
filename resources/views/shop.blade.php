@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Accueil</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop')}}">Boutique</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">filtrer par
                        catégories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            @foreach (\App\Http\Controllers\admin\CategoryController::getAllCategories() as $category)
                                <a href="{{ route('showCategory', $category->id) }}" class="nav-item nav-link"><img
                                        src="{{ asset('uploads/categories/' . $category->image) }}" width="40"
                                        class="mr-2" alt="">
                                    <span>{{ $category->name }}</span></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="">
                                    <form action="#" id="form-add-product-cart" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" class="product_id"
                                            value="{{ $product->id }}" id="product_id">
                                        <input type="hidden" name="quantity" class="quantity" value="1"
                                            id="quantity">
                                        <div class="product-action">
                                            <button class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="{{ route('details', $product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="pagination-box">
                            {{ $products->links('pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                var productId = $(this).children(".product_id").val();
                var quantity = $(this).children(".quantity").val();
                var csrfToken = $('input[name="_token"]').val();

                $.ajax({
                    url: '/cart/add',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        _token: csrfToken
                    },
                    success: function(response) {
                        // Handle the success response
                        // console.log(response.message);
                        if (response.message == "success") {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Produit a été ajouté'
                            });
                            let newCount = parseInt($('.cart-count-x').text());
                            $('.cart-count-x').text(newCount + 1);
                        }
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        var errorMessage = response.message;
                        switch (errorMessage) {
                            case "login":
                                window.open('/login', '_self')
                                break;
                            case "exist":
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Produit déja exist'
                                })
                                break;
                        }
                    }
                });
            });
        });
    </script>
@endsection
