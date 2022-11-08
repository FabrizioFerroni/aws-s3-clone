@extends('main')
@section('title', 'Crear bucket')
@section('breadcrumb')
    <a class="text-decoration-none text-black" href="{{ url('/buckets') }}">Buckets</a>

    <li class="breadcrumb-item active"><span><a class="text-decoration-none text-black"
                href="{{ url('/buckets/' . $slug) }}">{{ $nombre }}</a></span></li>

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
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-folder-tab" data-bs-toggle="tab" data-bs-target="#nav-folder" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Carpeta</button>
                              <button class="nav-link" id="nav-file-tab" data-bs-toggle="tab" data-bs-target="#nav-file" type="button" role="tab" aria-controls="nav-file" aria-selected="false">Archivo</button>
                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-folder" role="tabpanel" aria-labelledby="nav-folder-tab">

                                <div class="card">
                                    <div class="card-body">
                                        {{ Form::open(['url' => '/crear/buckets/' . $slug   ]) }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Nombre:</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control text-capitalize outnone @error('name') is-invalid @enderror"
                                                placeholder="Ingrese el nombre">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <input type="hidden" class="form-control" name="type" value="folder">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary outnone">Crear</button>
                                    <a href="{{ url('/buckets/'. $slug) }}" class="btn btn-secondary outnone">Cancelar</a>
                                    </div>
                                    {{ Form::close() }}
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="nav-file" role="tabpanel" aria-labelledby="nav-file-tab">
                                <div class="card">
                                    <div class="card-body">
                                        {{ Form::open(['url' => '/crear/buckets/' . $slug , 'files' => true ]) }}
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
                                            <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror"">
                                            @error('file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <input type="hidden" name="type" value="file" class="form-control">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary outnone">Subir</button>
                                    <a href="{{ url('/buckets/'. $slug) }}" class="btn btn-secondary outnone">Cancelar</a>
                                    </div>
                                    {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>

                </div>
            </div>
        </div>
    </div>







@endsection
