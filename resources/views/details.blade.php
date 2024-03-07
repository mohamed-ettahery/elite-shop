@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Accueil</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Boutique</a>
                    <span class="breadcrumb-item active">Détail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('uploads/products/' . $product->image) }}"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
                    <p class="mb-4">
                        {!! $product->description !!}
                    </p>

                    <form action="#" id="form-add-product-cart" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id">
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus" type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" class="form-control bg-secondary border-0 text-center" id="quantity"
                                    min="1" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Ajouter au
                                panier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Informations</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Description du produit</h4>
                            <p>

                                {!! $product->description !!}
                            </p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Informations Complémentaires</h4>
                            <p>
                                {!! $product->information !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                var productId = $("#product_id").val();
                var quantity = $("#quantity").val();
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
                        // if (errorMessage == "login") {
                        //     window.open('/login', '_self')
                        // } else {
                        //     console.log(errorMessage);
                        // }
                    }
                });
            });
        });
    </script>
@endsection
