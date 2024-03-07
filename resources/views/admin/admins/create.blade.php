@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ajouter Admin</h5>
            <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="adminName">Nom de l'admin</label>
                    <input type="text" class="form-control" name="name" id="adminName" value="{{ old('name') }}"
                        placeholder="Entrer le nom de admin">
                    @if ($errors->has('name'))
                        <p class="form-text text-danger">
                            Entrer le nom de l'admin
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminEmail">Email de l'admin</label>
                    <input type="email" class="form-control" name="email" id="adminEmail" value="{{ old('email') }}"
                        placeholder="Entrer le email de admin">
                    @if ($errors->has('email'))
                        <p class="form-text text-danger">
                            Entrer mail de l'admin
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminPaasword">Mot de passe de l'admin</label>
                    <input type="password" class="form-control" name="password" id="adminPaasword"
                        value="{{ old('password') }}" placeholder="Entrer le mot de passe de l'admin">
                    @if ($errors->has('password'))
                        <p class="form-text text-danger">
                            Entrer le mot de passe de l'admin ( A partir de 6 caractères)
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminCPaasword">Cinfirmer le mot de passe</label>
                    <input type="password" class="form-control" name="c_password" id="adminCPaasword"
                        value="{{ old('c_password') }}" placeholder="Entrer le mot de passe de l'admin">
                    @if ($errors->has('c_password'))
                        <p class="form-text text-danger">
                            Entrer le même mot de passe
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminName">Choisir l'image de profile</label>
                    <input accept="image/*" type="file" id="img-file" name="image" class="form-control"
                        name="img">
                    <img style="width: 200px;cursor: pointer;" class="new-img-insert mt-2" src='' />
                    @if ($errors->has('image'))
                        <p class="form-text text-danger">
                            Choisir une image de format (png/jpg/jpeg/webp)(moins de 2 mp)
                        </p>
                    @endif
                </div>
                <div class="text-center"><button type="submit" class="btn btn-primary mt-3">Ajouter <i
                            class="fa-solid fa-check"></i></button></div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const input = document.getElementById('img-file');
        const newImgField = document.querySelector('.new-img-insert');

        newImgField.addEventListener("click", function() {
            input.click();
        });

        input.addEventListener('change', function(e) {
            const reader = new FileReader()
            reader.onload = function() {
                var src = reader.result
                $('.new-img-insert').attr("src", src);
            }
            reader.readAsDataURL(input.files[0])
        }, false);
    </script>
@endsection
