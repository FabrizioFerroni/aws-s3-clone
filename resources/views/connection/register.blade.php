@extends('main-login')
@section('title', 'Registrate')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mb-4 mx-4">
                        <div class="card-body p-4">
                            <h1>Registrate aquí</h1>
                            <p class="text-medium-emphasis">Crea tu cuenta gratis</p>
                            @include('error')
                            {{ Form::open(['url' => '/registrarse']) }}
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3"><span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                                    </svg></span>
                                <input class="form-control outnone @error('name') is-invalid @enderror" name="name"
                                    type="text" placeholder="Nombre completo">
                            </div>

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3"><span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                    </svg></span>
                                <input class="form-control outnone @error('email') is-invalid @enderror" name="email"
                                    type="text" placeholder="Email">
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3"><span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                    </svg></span>
                                <input class="form-control outnone @error('password') is-invalid @enderror" name="password"
                                    type="password" placeholder="Contraseña">
                            </div>
                            @error('rpassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-4"><span class="input-group-text">
                                    <svg class="icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                    </svg></span>
                                <input class="form-control outnone @error('rpassword') is-invalid @enderror"
                                    name="rpassword" type="password" placeholder="Repetir contraseña">
                            </div>

                            <button class="btn btn-block btn-success outnone text-white" type="submit">Crear
                                Cuenta</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
