@extends('admin.layouts.master')
@section('content')
    <div class='card'>
        <div class='card-body'>
            <h5 class="card-title fw-semibold mb-4">Modifier Produit</h5>
            <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="adminName">Nom de l'admin</label>
                    <input type="text" class="form-control" name="name" id="adminName"
                        value="{{ old('name', $admin->name) }}" placeholder="Entrer le nom de admin">
                    @if ($errors->has('name'))
                        <p class="invalid-item">
                            Entrer le nom de l'admin
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminEmail">Email de l'admin</label>
                    <input type="email" class="form-control" name="email" id="adminEmail"
                        value="{{ old('email', $admin->email) }}" placeholder="Entrer le email de admin">
                    @if ($errors->has('email'))
                        <p class="invalid-item">
                            Entrer mail de l'admin
                        </p>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <label for="adminName">Choisir l'image de profile</label>
                    <input type="hidden" name="old_img" value="{{ $admin->image }}">
                    <input style="display:none;" accept="image/*" type="file" id="img-file" name="image"
                        class="form-control" name="img" placeholder="test">
                    <img style="width: 200px;cursor: pointer;" class="new-img-insert"
                        src='{{ asset("/uploads/profiles/{$admin->image}") }}' />
                    @if ($errors->has('image'))
                        <p class="invalid-item">
                            Choisir une image de format (png/jpg/jpeg/webp)(moins de 2 mp)
                        </p>
                    @endif
                </div>
                <div class="text-center"><button type="submit" class="btn btn-primary mt-3">Confirmer les modifications <i
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
