<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('admin/css/styles.min.css') }}" />
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- DataTable --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <img src="{{ asset('assets/img/elite-shop.svg') }}" alt="">
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-gauge"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('categories.index') }}">
                                <span>
                                    <i class="fa-solid fa-sitemap"></i>
                                </span>
                                <span class="hide-menu">Catégories</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('products.index') }}">
                                <span>
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </span>
                                <span class="hide-menu">Produits</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('orders.index') }}">
                                <span>
                                    <i class="fa-solid fa-newspaper"></i>
                                </span>
                                <span class="hide-menu">Commanndes</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('users.index') }}">
                                <span>
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="hide-menu">Utilisateurs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admins.index') }}">
                                <span>
                                    <i class="fa-solid fa-user-tie"></i>
                                </span>
                                <span class="hide-menu">Admins</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('newsletters.index') }}">
                                <span>
                                    <i class="fa-solid fa-paper-plane"></i>
                                </span>
                                <span class="hide-menu">Newsletters</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('logout') }}">
                                <span>
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                <span class="hide-menu">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @php
                                        $admin = DB::table('users')
                                            ->where('id', session()->get('admin'))
                                            ->first();
                                    @endphp
                                    <img src="{{ asset('uploads/profiles/' . $admin->image) }}" alt=""
                                        width="35" height="35" class="rounded-circle"> <span
                                        class="mx-2">{{ $admin->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('adminProfile') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-regular fa-user"></i>
                                            <p class="mb-0 fs-3">Profile</p>
                                        </a>
                                        <a href="{{ route('adminPassword') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-solid fa-lock"></i>
                                            <p class="mb-0 fs-3">Mot de passe</p>
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Déconnexion</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/js/app.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- dataTable --}}
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(".btn-delete").on('click', function(e) {
            "use strict";
            e.preventDefault();
            // if (confirm("Es-tu sûr de vouloir le supprimer ?")) {
            //     let idForm = "delete-form-" + $(this).data('id');
            //     $("#" + idForm).submit();
            // }
            Swal.fire({
                title: 'Sûre?',
                text: 'Es-tu sûr de vouloir le supprimer ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    let idForm = "delete-form-" + $(this).data('id');
                    $("#" + idForm).submit();
                }
            });
        });
        $('#myTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }

        });

        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
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
    @yield('js')
</body>

</html>
