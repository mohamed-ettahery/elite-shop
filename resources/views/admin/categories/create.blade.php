@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ajouter Catégorie</h5>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom de catégorie</label>
                    <input type="text" class="form-control" name="name" placeholder="nom de catégorie">
                    <div class="form-text @if ($errors->has('name')) text-danger @endif">
                        Saisir un nom valid. @if ($errors->has('name'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Choisir l'image</label>
                    <input class="form-control" accept="image/*" type="file" name="image" id="img-file">
                    @if ($errors->has('client'))
                        <div class="form-text text-danger">
                            Entrer une image valide (taille max : 2mb) . <i class="fa-regular fa-circle-exclamation"
                                style="color: #e63205;"></i>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <img src="" class="new-img-insert" alt="" style="width: 200px;display:none">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const input = document.getElementById('img-file');
        input.addEventListener('change', function(e) {
            const reader = new FileReader()
            reader.onload = function() {
                var src = reader.result
                $('.new-img-insert').attr("src", src);
                $('.new-img-insert').show();
            }
            reader.readAsDataURL(input.files[0])
        }, false);
    </script>
@endsection
