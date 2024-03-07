@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Catégories</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('categories.create') }}"><i class="fa-duotone fa-plus"></i> Ajouter une nouvelle
                        catégorie</a>
                </div>
            </div>
            <div class="view-table-box">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom de catégorie</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}" width="60"
                                        alt="">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td class="text-end">
                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                        id="delete-form-{{ $category->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" data-id="{{ $category->id }}" class="btn btn-danger btn-delete"><i
                                            class="fa-regular fa-trash-can"></i></a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success"><i
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
