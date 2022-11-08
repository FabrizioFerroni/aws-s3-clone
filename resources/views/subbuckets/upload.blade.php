@extends('main')
@section('title', 'Crear bucket')
@section('breadcrumb')
    <a class="text-decoration-none text-black" href="{{ url('/buckets') }}">Buckets</a>

    <li class="breadcrumb-item active"><span><a class="text-decoration-none text-black"
                href="{{ url('/buckets/' . $nombre) }}">{{ Str::headline($nombre) }}</a></span></li>

                <li class="breadcrumb-item active"><span><a class="text-decoration-none text-black"
                    href="{{ url('/buckets/' . $nombre . '/' . $subnombre) }}">{{ Str::headline($subnombre) }}</a></span></li>

    <li class="breadcrumb-item active"><span>Subir archivo</span></li>


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
                            <h5 class="card-title">
                                Subir archivo
                            </h5>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['url' => '/subir/' . $nombre . '/' . $subnombre, 'files' => true]) }}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Nombre:</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control outnone @error('name') is-invalid @enderror"
                                        placeholder="Ingrese el nombre">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="">Subir archivo:</label>
                                    <input type="file" name="file" id="file"
                                        class="form-control @error('file') is-invalid @enderror"">
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="hidden" class="form-control" name="idb" value="{{ $idb }}">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary outnone">Subir</button>
                                <a href="{{ url('/buckets/' . $nombre . '/' . $subnombre) }}" class="btn btn-secondary outnone">Cancelar</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
