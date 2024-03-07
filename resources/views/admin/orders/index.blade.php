@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Commandes</h5>
                </div>
            </div>
            <div class="view-table-box">
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle" id="myTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Client</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date commande</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $order->id }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $order->user->name }}</h6>
                                        <span class="fw-normal">{{ $order->user->email }}</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $order->created_at }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        @php
                                            $badge = 'bg-primary';
                                            switch ($order->status) {
                                                case 'confirmé':
                                                    $badge = 'bg-success';
                                                    break;
                                                case 'supprimé':
                                                    $badge = 'bg-danger';
                                                    break;
                                            
                                                default:
                                                    $badge = 'bg-primary';
                                                    break;
                                            }
                                        @endphp
                                        <div class="d-flex align-items-center gap-2">
                                            <span
                                                class="badge {{ $badge }} rounded-3 fw-semibold">{{ $order->status }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-view-details"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-order={{ $order->id }}>
                                            <i class="fa-solid fa-chart-bar"></i> Détails
                                        </button>
                                    </td>
                                    <td class="text-end">
                                        @if ($order->status == 'en cours')
                                            <form action="{{ route('orders.destroy', $order->id) }}"
                                                id="delete-form-{{ $order->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#" data-id="{{ $order->id }}"
                                                class="btn btn-danger btn-delete"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                            <a href="{{ route('orders.confirm', $order->id) }}" class="btn btn-success"><i
                                                    class="fa-regular fa-circle-check"></i></a>
                                        @endif
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
    </div>
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
                                        <td><img src="../uploads/products/` + item.product.image + `" width="50"/></td>
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
