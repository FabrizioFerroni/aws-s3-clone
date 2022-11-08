@extends('main')
@section('title', 'Buckets')
@section('breadcrumb', 'Buckets')
@section('custom_js')


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js">
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js">
    </script>


    <script src="{{ url('js/bucket.js?v=' . time()) }}"></script>


@endsection
@section('content')


    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" d-flex align-items-center justify-content-between">
                                <h6 class="card-title align-middle pt-2">Buckets</h6>
                                <a href="{{ url('/crear/buckets') }}" class="float-end btn btn-sm btn-success text-white outnone">Crear nuevo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="buckets_table"
                                class="display table table-hover table-striped table-borderless outnone"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Region</th>
                                        <th>Acceso</th>
                                        <th>Fecha de creación</th>
                                        <th width="70px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buckets as $bucket)
                                        <tr>
                                            <td><input type="checkbox" name="" id=""></td>
                                            <td>
                                                <a href="{{ url('/buckets/' . $bucket->slug) }}"
                                                    class="text-decoration-none text-capitalize">{{ $bucket->nombre }}</a>
                                            </td>
                                            <td>{{ $bucket->region }}</td>
                                            <td>
                                                @if ($bucket->accceso === 1)
                                                    Los objetos pueden ser públicos
                                                @endif

                                                @if ($bucket->accceso === 0)
                                                    Los objetos no son públicos
                                                @endif
                                            </td>
                                            <td>{{ $bucket->created_at->format('j M  Y g:i:s A T') }}</td>
                                            <td>
                                                <a href="{{ url('editar/bucket/'. $bucket->slug ) }}" class="btn btn-info text-white" href="#" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Editar"><i class="fas fa-pen"></i></a>
                                                <a data-path="borrar/bucket" data-action="borrar" data-object="{{ $bucket->id }}" class="btn-deleted btn btn-danger text-white" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Borrar"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo Bucket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url' => '/buckets']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Nombre:</label>
                            <input type="text" name="nombre"
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

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary outnone">Crear</button>
                    <button type="button" class="btn btn-secondary outnone" data-bs-dismiss="modal">Cancelar</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>




@endsection
