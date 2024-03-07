@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Accueil</a>
                    <span class="breadcrumb-item active">Recherche</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    {{-- Start search content --}}
    <div class="search-content p-5">
        <div class="container">
            {{-- Start Header --}}
            <div class="info-result m-4 p-2">
                <h2 class="result-term best-black">résultat de la recherche pour : <span
                        class="term text-primary">{{ $term }}</span>
                </h2>
                <h6 class="result-count best-black">Résultats : <span class="count text-primary">{{ $productCount }}</span>
                </h6>
            </div>
            {{-- End Header --}}
            {{-- Start Display Result --}}
            <div class="poducts-results">
                <div class="row">
                    <div class="col-md-9">
                        @forelse ($products as $product)
                            <div class="result-item mb-2">
                                <a href="{{ route('details', $product->id) }}" class="btn">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img-box">
                                                <img src='{{ asset("/uploads/products/{$product->image}") }}'
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="description-box pt-3">
                                                <p class="category-name">{{ $product->category->name }}</p>
                                                <h4 class="product-name best-black">
                                                    {{ $product->name }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p>Aucun résultat trouvé.</p>
                        @endforelse
                    </div>
                    <div class="col-md-3">
                        <!-- Shop Sidebar Start -->
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">catégories</span></h5>
                        <div class="bg-light p-4 mb-30">
                            <div class="navbar-nav w-100">
                                <div class="nav-item dropdown dropright">
                                    @foreach (\App\Http\Controllers\admin\CategoryController::getAllCategories() as $category)
                                        <a href="{{ route('showCategory', $category->id) }}" class="nav-item nav-link"><img
                                                src="{{ asset('uploads/categories/' . $category->image) }}" width="40"
                                                class="mr-2" alt="">
                                            <span>{{ $category->name }}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Shop Sidebar End -->
                    </div>
                    {{-- Start Pagination --}}
                    <div class="col-md-9 pagination-box mt-3">
                        {{ $products->links('pagination.bootstrap-5') }}
                    </div>
                    {{-- End Pagination --}}
                </div>
            </div>
            {{-- End Display Result --}}
        </div>
    </div>
    {{-- Start search content --}}
@endsection
