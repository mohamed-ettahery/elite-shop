@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Accueil</a>
                    <span class="breadcrumb-item active">Profile</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Profile Start -->
    <div class="container">
        <div class="row px-xl-5">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('uploads/profiles/' . $user->image) }}" width="200px" alt="Profile Image"
                            class="img-fluid rounded-circle mx-auto d-block" />
                        <h4 class="text-center my-3">{{ $user->name }}</h4>
                        <p class="text-center">{{ $user->email }}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary mx-auto d-block" onclick="toggleForm()">
                            <i class="fa-solid fa-user-pen"></i> Modifier
                        </button>
                    </div>
                </div>
            </div>
            <div class="container mt-5 d-none" id="form-container">
                <form id="edit-form" action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label>changer profile</label><br />
                        <input style="display:none;" accept="image/*" type="file" id="img-file" name="image"
                            class="form-control">
                        <img style="width: 200px;cursor: pointer;" class="new-img-insert mb-2 mt-2"
                            src='{{ asset('/assets/img/upload.png') }}' />
                        @if ($errors->has('image'))
                            <p class="invalid-item">
                                Choisir une image de format (png/jpg/jpeg/webp)(moins de 2 mp)
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control check input-name"
                            name="name"value="{{ $user->name }}" required />
                        @if ($errors->has('name'))
                            <p class="invalid-item">
                                Saisir votre nom
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" class="form-control check input-name"
                            name="city"value="{{ $user->city }}" required />
                        @if ($errors->has('city'))
                            <p class="invalid-item">
                                Saisir votre ville
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control check" name="address" value="{{ $user->address }}"
                            required />
                        @if ($errors->has('address'))
                            <p class="invalid-item">
                                Saisir votre adresse
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" class="form-control check" name="phone" value="{{ $user->phone }}"
                            required />
                        @if ($errors->has('phone'))
                            <p class="invalid-item">
                                Saisir votre telephone
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control check input-email" name="email" id="email"
                            value="{{ $user->email }}" required />
                        @if ($errors->has('email'))
                            <p class="invalid-item">
                                Saisir votre email
                            </p>
                        @endif
                    </div>
                    <div class="btns-box text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-save d-inline-block">
                            <i class="fa-solid fa-circle-check"></i> Sauvegarder
                        </button>
                        <button type="button" class="btn btn-secondary d-inline-block" onclick="toggleForm()">
                            <i class="fa-solid fa-xmark"></i> Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Profile End -->
@endsection
@section('js')
    <script>
        function toggleForm() {
            document.getElementById("form-container").classList.toggle("d-none");
        }

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
