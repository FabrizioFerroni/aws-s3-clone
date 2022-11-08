@extends('main-login')
@section('title', 'Iniciar sesion')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Iniciar sesion</h1>
                                <p class="text-medium-emphasis">Iniciar sesión en su cuenta</p>
                                @include('error')
                                {{ Form::open(['url' => '/iniciarsesion']) }}
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                        </svg></span>
                                    <input name="email" class="form-control outnone @error('email') is-invalid @enderror"
                                        type="email" placeholder="Email">

                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input name="password"
                                        class="form-control outnone @error('password') is-invalid @enderror" type="password"
                                        placeholder="Password">

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        {{-- <button class="btn btn-primary px-4" type="submit">Iniciar sesion</button> --}}
                                        {!! Form::submit('Iniciar sesion', ['class' => 'btn btn-primary px-4 outnone']) !!}
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-link px-0 text-decoration-none outnone" type="button">Olvide
                                            mi
                                            clave</button>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Registrarse</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                    <a class="btn btn-lg btn-outline-light mt-3 outnone"
                                        href="{{ url('/registrarse') }}">Registrate
                                        Ahora!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
