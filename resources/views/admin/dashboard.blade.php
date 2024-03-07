@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row p-lg-5">
            <div class="col-md-3">
                <div class="box-stats mb-2 border-bottom pb-3">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa-solid fa-users" style="font-size: 45px;"></i>
                        </div>
                        <div class="col-8">
                            <h5>Utilisateurs</h5>
                            <h6>@php
                                $count = DB::table('users')
                                    ->where('is_admin', 0)
                                    ->get();
                                echo count($count);
                            @endphp</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-stats mb-2 border-bottom pb-3">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa-solid fa-boxes-stacked" style="font-size: 45px;"></i>
                        </div>
                        <div class="col-8">
                            <h5>Commandes</h5>
                            <h6>@php
                                $count = DB::table('orders')->get();
                                echo count($count);
                            @endphp</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-stats mb-2 border-bottom pb-3">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa-solid fa-sitemap" style="font-size: 45px;"></i>
                        </div>
                        <div class="col-8">
                            <h5>Catégories</h5>
                            <h6>@php
                                $count = DB::table('categories')->get();
                                echo count($count);
                            @endphp</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box-stats mb-2 border-bottom pb-3">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa-solid fa-box" style="font-size: 45px;"></i>
                        </div>
                        <div class="col-8">
                            <h5>Produits</h5>
                            <h6>@php
                                $count = DB::table('products')->get();
                                echo count($count);
                            @endphp</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Dernières commandes</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
