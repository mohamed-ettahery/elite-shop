@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Admins</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('admins.create') }}"><i class="fa-duotone fa-plus"></i> Ajouter admin</a>
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
                        @foreach ($admins as $admin)
                            <tr>
                                <th scope="row" class="pt-td">{{ $admin->id }}</th>
                                <td>
                                    <img src="{{ asset('uploads/profiles/' . $admin->image) }}" alt=""
                                        style="width: 45px;" class="rounded-circle">
                                </td>
                                <td class="pt-td">{{ $admin->name }}</td>
                                <td class="pt-td">{{ $admin->email }}</td>
                                <td class="pt-td">{{ $admin->created_at }}</td>
                                <td class="text-center">
                                    @if (session()->get('admin') != $admin->id)
                                        {{-- <form action="{{ route('admins.edit', $admin->id) }}" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="modifier admin">
                                                modifier</button>
                                        </form> --}}
                                        <form action="{{ route('admins.destroy', $admin->id) }}"
                                            id="delete-form-{{ $admin->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-success"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="#" data-id="{{ $admin->id }}" class="btn btn-danger btn-delete"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
