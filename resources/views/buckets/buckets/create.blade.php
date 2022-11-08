@extends('main')
@section('title', 'Crear bucket')
@section('breadcrumb')
    <a class="text-decoration-none text-black" href="{{ url('/buckets') }}">Buckets</a>

    <li class="breadcrumb-item active"><span>Crear nuevo</span></li>


@endsection
@section('custom_js')
@endsection
@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex align-items-center justify-content-between">
                            <h6 class="card-title align-middle pt-2">Crear Buckets</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['url' => '/buckets']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Nombre:</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="form-control outnone @error('nombre') is-invalid @enderror"
                                placeholder="Ingrese el nombre">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Región:</label>
                            <select name="region" class="form-select outnone @error('region') is-invalid @enderror"
                                id="region" readonly>
                                <option value="Central" selected readonly>Central</option>
                            </select>
                            @error('region')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Acceso:</label>
                            <select name="acceso" id="acceso"
                                class="form-select outnone @error('acceso') is-invalid @enderror">
                                <option value="" disabled hidden selected>Seleccione una opción</option>
                                <option value="1">Los objetos pueden ser públicos </option>
                                <option value="0">Los objetos no son públicos</option>
                            </select>
                            @error('acceso')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary outnone">Crear</button>
                    <a href="{{ url('/buckets') }}" class="btn btn-secondary outnone">Cancelar</a>
                    </div>
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection
