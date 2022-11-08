@extends('main-error')
@section('title', 'Oops hubo un error')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div
                        class="clearfix d-flex justify-content-center align-content-center flex-wrap align-items-center flex-column">
                        <img src={{ asset('img/emoji.png') }} alt="Error 404" width="200px" />
                        <h1 class="float-start display-3 me-4">404</h1>
                        <h4 class="pt-3">¡Ups! Estas perdido.</h4>
                        <p class="text-medium-emphasis">No se encontró la página que está buscando.</p>
                    </div>
                    <div class="d-flex justify-content-center align-content-center">

                        <a href="/" class="btn btn-info text-white" type="button">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
