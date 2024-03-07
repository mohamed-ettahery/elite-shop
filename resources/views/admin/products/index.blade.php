@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Produits</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('products.create') }}"><i class="fa-duotone fa-plus"></i> Ajouter un nouvelle
                        produit</a>
                </div>
            </div>
            <div class="view-table-box">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" width="60"
                                        alt="">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td class="text-end">
                                    <form action="{{ route('products.destroy', $product->id) }}"
                                        id="delete-form-{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" data-id="{{ $product->id }}" class="btn btn-danger btn-delete"><i
                                            class="fa-regular fa-trash-can"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success"><i
                                            class="fa-regular fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
