@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Accueil</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Boutique</a>
                    <span class="breadcrumb-item active">Panier</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            @if (count($cartItems) > 0)
                <div class="col-lg-8 table-responsive mb-5">

                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="2">Produits</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                                @php
                                    $total = $total + $item->product->price * $item->quantity;
                                @endphp
                                <tr>
                                    <td class="align-middle"><img
                                            src="{{ asset('uploads/products/' . $item->product->image) }}" alt=""
                                            style="width: 50px;">
                                    </td>
                                    <td class="align-middle">{{ $item->product->name }}</td>
                                    <td class="align-middle">${{ $item->product->price }}</td>
                                    <td class="align-middle">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="align-middle">${{ $item->product->price * $item->quantity }}</td>
                                    <td class="align-middle">
                                        <form action="#">
                                            @csrf
                                            <input type="hidden" id="product_id" value="{{ $item->product_id }}">
                                            <button type="button" data-product="{{ $item->product_id }}"
                                                data-total="{{ $item->product->price * $item->quantity }}"
                                                class="btn btn-sm btn-danger delete-cart-product"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Résumé
                            du panier</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>$<span class="total-checkout">{{ $total }}</span></h5>
                            </div>
                            <button
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3 btn-proced">Commander</button>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Votre panier est vide</p>
            @endif
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".delete-cart-product").click(function(e) {
                "use strict";
                e.preventDefault();

                var productId = $(this).data("product");
                var productTotal = $(this).data("total");
                var csrfToken = $('input[name="_token"]').val();
                var deleteButton = $(this); // Store reference to $(this)

                $.ajax({
                    url: '/cart/delete',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.message == "success") {
                            deleteButton.closest('tr').remove();
                            $(".total-checkout").text(parseInt($(".total-checkout").text()) -
                                productTotal);
                            let newCount = parseInt($('.cart-count-x').text());
                            $('.cart-count-x').text(newCount - 1);
                        }
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        var errorMessage = response.message;
                        console.log(errorMessage);
                    }
                });
            });
            $('.btn-proced').click(function(e) {
                "use strict";
                e.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                Swal.fire({
                    title: 'Voulez-vous confirmer votre commande ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer',
                    CancelButtonText: 'Fermer',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/shop/send-order',
                            method: 'POST',
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                if (response.message == "success") {
                                    Swal.fire('Votre commande a été envoyé!', '',
                                        'success').then((result) => {
                                        window.open("/orders", "_self");
                                    })
                                } else {
                                    console.log('no');
                                }
                            },
                            error: function(xhr, status, error) {
                                var response = JSON.parse(xhr.responseText);
                                var errorMessage = response.message;
                                console.log(errorMessage);
                            }
                        });
                    }
                })
            })
        });
    </script>
@endsection
