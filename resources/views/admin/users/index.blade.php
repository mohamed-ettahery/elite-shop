@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Utilisateurs</h5>
                </div>
            </div>
            <div class="view-table-box">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date de création</th>
                            <th scope="col" style="width: 30%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row" class="pt-td">{{ $user->id }}</th>
                                <td>
                                    <img src="{{ asset('uploads/profiles/' . $user->image) }}" alt=""
                                        style="width: 45px;" class="rounded-circle">
                                </td>
                                <td class="pt-td">{{ $user->name }}</td>
                                <td class="pt-td">{{ $user->email }}</td>
                                <td class="pt-td">{{ $user->created_at }}</td>
                                @if (session()->get('user') != $user->id)
                                    <td class="text-center">
                                        <form action="{{ route('users.destroy', $user->id) }}"
                                            id="delete-form-{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" data-id="{{ $user->id }}" class="btn btn-danger btn-delete"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
