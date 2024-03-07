@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ajouter Produit</h5>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom de produit</label>
                    <input type="text" class="form-control" name="name" placeholder="nom de produit">
                    <div class="form-text @if ($errors->has('name')) text-danger @endif">
                        Saisir un nom valid. @if ($errors->has('name'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prix de produit</label>
                    <input type="text" class="form-control" name="price" placeholder="prix de produit">
                    <div class="form-text @if ($errors->has('price')) text-danger @endif">
                        Saisir un prix valid. @if ($errors->has('price'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select name="category_id" class="form-select">
                        @foreach (\App\Http\Controllers\admin\CategoryController::getAllcategories() as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text @if ($errors->has('category_id')) text-danger @endif">
                        Choisir une catégorie. @if ($errors->has('category_id'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="mytextarea" name="description" placeholder="description de produit" cols="30"
                        rows="10"></textarea>
                    <div class="form-text @if ($errors->has('description')) text-danger @endif">
                        Entrer le description. @if ($errors->has('description'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Informations</label>
                    <textarea class="form-control" id="mytextarea" name="information" placeholder="informations de produit" cols="30" rows="10"></textarea>
                    <div class="form-text @if ($errors->has('information')) text-danger @endif">
                        Entrer les informations. @if ($errors->has('information'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Choisir l'image</label>
                    <input class="form-control" accept="image/*" type="file" name="image" id="img-file">
                    @if ($errors->has('image'))
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
