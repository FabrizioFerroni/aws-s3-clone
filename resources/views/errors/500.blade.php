@extends('main-error')
@section('title', 'Server error')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div
                        class="clearfix d-flex justify-content-center align-content-center flex-wrap align-items-center flex-column">
                        <img src={{ asset('img/error500.png') }} alt="Error 404" width="300px" />
                        <h1 class="float-start display-3 me-4">500</h1>
                        <h4 class="pt-3">¡Houston, tenemos un problema!</h4>
                        <p class="text-medium-emphasis">La página que está buscando no está disponible temporalmente.</p>
                    </div>
                    <div class="d-flex justify-content-center align-content-center">

                        <a href="/" class="btn btn-info text-white" type="button">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
