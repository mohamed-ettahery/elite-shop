@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Modifier Produit</h5>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nom de produit</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}"
                        placeholder="nom de produit">
                    <div class="form-text @if ($errors->has('name')) text-danger @endif">
                        Saisir un nom valid. @if ($errors->has('name'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prix de produit</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}"
                        placeholder="prix de produit">
                    <div class="form-text @if ($errors->has('price')) text-danger @endif">
                        Saisir un prix valid. @if ($errors->has('price'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select name="category_id" class="form-select">
                        @foreach (\App\Http\Controllers\admin\CategoryController::getAllcategories() as $category)
                            <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
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
                    <textarea class="form-control" name="description" id="mytextarea" placeholder="description de produit" cols="30"
                        rows="10">{{ $product->description }}</textarea>
                    <div class="form-text @if ($errors->has('description')) text-danger @endif">
                        Entrer le description. @if ($errors->has('description'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Informations</label>
                    <textarea class="form-control" name="information" id="mytextarea" placeholder="informations de produit" cols="30"
                        rows="10">{{ $product->information }}</textarea>
                    <div class="form-text @if ($errors->has('information')) text-danger @endif">
                        Entrer les informations. @if ($errors->has('information'))
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Choisir l'image</label>
                    <input class="form-control" accept="image/*" type="file" name="image" id="img-file">
                    <input type="hidden" name="old_img" value="{{ $product->image }}">
                    @if ($errors->has('client'))
                        <div class="form-text text-danger">
                            Entrer une image valide (taille max : 2mb) . <i class="fa-regular fa-circle-exclamation"
                                style="color: #e63205;"></i>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="new-img-insert" alt=""
                        style="width: 200px;">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
@endsection
