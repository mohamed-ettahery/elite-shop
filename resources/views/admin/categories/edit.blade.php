@extends('admin.layouts.master')
@section('content')
    <h5 class="card-title fw-semibold mb-4">Modifier catégorie</h5>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nom de catégorie</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                placeholder="nom de catégorie" required>
            <div class="form-text @if ($errors->has('name')) text-danger @endif">
                Saisir un nom valid. @if ($errors->has('name'))
                @endif
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Choisir l'image</label>
            <input class="form-control" accept="image/*" type="file" name="image" id="img-file">
            <input type="hidden" name="old_img" value="{{ $category->image }}">
            @if ($errors->has('client'))
                <div class="form-text text-danger">
                    Entrer une image valide (taille max : 2mb) . <i class="fa-regular fa-circle-exclamation"
                        style="color: #e63205;"></i>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <img src="{{ asset('uploads/categories/' . $category->image) }}" class="new-img-insert" alt=""
                style="width: 200px;">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-badge-check"></i> Modifier</button>
    </form>
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
