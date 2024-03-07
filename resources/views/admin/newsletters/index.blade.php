@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4">Newsletters</h5>
                </div>
            </div>
            <div class="view-table-box">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date de création</th>
                            <th scope="col" style="width: 30%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsletters as $newsletter)
                            <tr>
                                <th scope="row" class="pt-td">{{ $newsletter->id }}</th>
                                <td class="pt-td">{{ $newsletter->email }}</td>
                                <td class="pt-td">{{ $newsletter->created_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('newsletters.destroy', $newsletter->id) }}"
                                        id="delete-form-{{ $newsletter->id }}" method="POST">
                                        <input type="hidden" value="{{ $newsletter->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" data-id="{{ $newsletter->id }}" class="btn btn-danger btn-delete"><i
                                            class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
