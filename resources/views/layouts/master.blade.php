<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Elite Shop </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <i class="far fa-envelope mr-2"></i> <span>{{ $site_mail }}</span>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if (session()->has('user'))
                        @php
                            $user = DB::table('users')
                                ->where('id', session()->get('user'))
                                ->first();
                        @endphp
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('uploads/profiles/' . $user->image) }}" alt="" width="35"
                                    height="35" class="rounded-circle"> <span
                                    class="mx-2">{{ $user->name }}</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('password') }}">Mot de passe</a>
                                <a class="dropdown-item" href="{{ route('viewOrders') }}">Mes commandes</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Déconnexion</a>
                            </div>
                        </div>
                    @else
                        <div class="btn-group" style="z-index: 999;">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                data-toggle="dropdown">mon compte</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('login.index') }}" class="dropdown-item">Connéxion</a>
                                <a href="{{ route('login.index') }}" class="dropdown-item">Inscription</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    {{-- <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span> --}}
                    <img src="{{ asset('assets/img/elite-shop.svg') }}" style="position: absolute;top: -148px;"
                        alt="">
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="{{ route('search') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ old('search', $term ?? '') }}" required
                            name="term" placeholder="Rechercher des produits">
                        <button class="input-group-append btn btn-outline-primary" type="submit" id="btnGroupAddon2">
                            <span class="bg-transparent">
                                <i class="fa fa-search"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Service Clients</p>
                <h5 class="m-0">{{ $site_phone }}</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Catégories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
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
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="/" class="text-decoration-none d-block d-lg-none">
                        <img src="{{ asset('assets/img/elite-shop-light.svg') }}"
                            style="position: absolute;top: -74px;left: -49px;width: 300px;" alt="">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('home') }}" class="nav-item nav-link active">Accueil</a>
                            <a href="{{ route('shop') }}" class="nav-item nav-link">Produits</a>
                            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        @if (session()->has('user'))
                            @php
                                $count = DB::table('cart')
                                    ->where('user_id', session()->get('user'))
                                    ->get();
                            @endphp
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <a href="{{ route('cart') }}" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span
                                        class="badge text-secondary border border-secondary rounded-circle cart-count-x"
                                        style="padding-bottom: 2px;">{{ count($count) }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    @yield('content')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Elite Shop</h5>
                <p class="mb-4">
                    Bienvenue sur notre site web ecommerce, votre destination ultime pour l'achat de produits dans une
                    variété de catégories. Que vous recherchiez des vêtements tendance, des gadgets électroniques
                    innovants, des articles pour la maison ou des accessoires de mode, nous avons tout ce dont vous avez
                    besoin, et bien plus encore.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $site_address }}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $site_mail }}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $site_phone }}</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Boutique rapide</h5>
                        <div class="d-flex flex-column justify-content-start">
                            @foreach (\App\Http\Controllers\admin\CategoryController::getAllCategories() as $category)
                                <a class="text-secondary mb-2" href="{{ route('showCategory', $category->id) }}"><i
                                        class="fa fa-angle-right mr-2"></i>{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Liens rapides</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ route('home') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Accueil</a>
                            <a class="text-secondary mb-2" href="{{ route('shop') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Produits</a>
                            <a class="text-secondary" href="{{ route('contact') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Contact</a>
                            @if (session()->has('user'))
                                <a class="text-secondary" href="{{ route('profile') }}"><i
                                        class="fa fa-angle-right mr-2"></i>Profile</a>
                                <a class="text-secondary" href="{{ route('viewOrders') }}"><i
                                        class="fa fa-angle-right mr-2"></i>Commandes</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>vous pouvez tout savoir sur les nouveautés de notre magasin !</p>
                        <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Votre email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Suivez-nous</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; Elite shop
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#newsletter-form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        // Show success SweetAlert
                        Swal.fire('Success!', response.message, 'success');

                        // Clear the form
                        form.trigger('reset');
                    },
                    error: function(xhr) {
                        // Show error message, if any
                        Swal.fire('Error!', xhr.responseJSON.message, 'error');
                    }
                });
            });
        });
    </script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: 'Succés',
                text: "{{ session()->get('success') }}",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            })
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Echec',
                text: "{{ session()->get('error') }}",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            })
        </script>
    @endif

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
