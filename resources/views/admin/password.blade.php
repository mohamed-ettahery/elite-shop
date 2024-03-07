@extends('admin.layouts.master')
@section('content')
    <!-- Password Start -->
    <div class="container">
        <div class="px-xl-5">
            <div class="box-form-password">
                <form action="{{ route('updateAdminPassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label>Ancien mot de passe</label>
                        <input type="password" class="form-control" name="old_psw" value="{{ old('old_psw') }}"
                            placeholder="Entrer l'ancien mot de passe">
                        @if ($errors->has('old_psw'))
                            <p style="color:rgb(250, 74, 74)">
                                Entrer ancien mot de passe
                            </p>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label>Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="new_psw" value="{{ old('new_psw') }}"
                            placeholder="Entrer le nouveau mot de passe">
                        @if ($errors->has('new_psw'))
                            <p style="color:rgb(250, 74, 74)">
                                Entrer nouveau mot de passe (min : 6 caractères)
                            </p>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label>Ancien mot de passe</label>
                        <input type="password" class="form-control" name="c_new_psw" value="{{ old('c_new_psw') }}"
                            placeholder="Entrer la confirmation de mot de passe">
                        @if ($errors->has('c_new_psw'))
                            <p style="color:rgb(250, 74, 74)">
                                Entrer la confimation de nouveau mot de passe
                            </p>
                        @endif
                    </div>
                    <div class="box-btn">
                        <button type="submit" class="btn btn-primary">Changer mot de passe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Password End -->
@endsection
