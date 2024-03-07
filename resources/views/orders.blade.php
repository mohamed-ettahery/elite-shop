@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Accueil</a>
                    <span class="breadcrumb-item active">mes commandes</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container">
        <div class="row px-xl-5">
            <div class="table-responsive mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date Commande</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->created_at }}</td>
                                @php
                                    $badge = 'badge-info';
                                    switch ($order->status) {
                                        case 'confirmé':
                                            $badge = 'badge-success';
                                            break;
                                        case 'supprimé':
                                            $badge = 'badge-danger';
                                            break;
                                    
                                        default:
                                            $badge = 'badge-info';
                                            break;
                                    }
                                @endphp
                                <td>
                                    <span class="badge badge-pill {{ $badge }}"
                                        style="border-radius: 50px ">{{ $order->status }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-view-details" data-toggle="modal"
                                        data-target="#exampleModal" data-order={{ $order->id }}>
                                        Détails
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="box-table-order-details mb-2"></div>
                                <div class="box-total">
                                    <h4 class="text-center">Total : <span class="all-total"></span></h4>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('js')
    <script>
        $('.btn-view-details').click(function() {
            "use strict";
            var OrderId = $(this).data("order");
            $.ajax({
                url: "/order/details/" + OrderId,
                method: 'GET',
                data: {
                    // _token: csrfToken
                },
                success: function(response) {
                    if (response.message == "success") {
                        // console.log(response.details);
                        let total = 0;
                        let result = `<table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>`;
                        response.details.forEach(item => {
                            total += item.product.price * item.quantity;
                            // console.log(item.product_id);
                            result = result + `<tr>
                                        <td><img src="uploads/products/` + item.product.image + `" width="50"/></td>
                                        <th scope="row">` + item.product.name + `</th>
                                        <td>` + item.product.price + `</td>
                                        <td>` + item.quantity + `</td>
                                        <td>` + item.product.price * item.quantity + `</td>
                                        </td>
                                    </tr>`;
                        });
                        result = result + `</tbody>
                </table>`;
                        // console.log(result);
                        $('.box-table-order-details').html(result);
                        $('.all-total').text(total);
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
        });
    </script>
@endsection
