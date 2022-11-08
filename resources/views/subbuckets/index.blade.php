@extends('main')
@section('title', Str::headline($subnombre))
@section('breadcrumb')
    <a class="text-decoration-none text-black" href="{{ url('/buckets') }}">Buckets</a>

    <li class="breadcrumb-item active"><span><a class="text-decoration-none text-black"
                href="{{ url('/buckets/' . $nombre) }}">{{ Str::headline($nombre) }}</a></span></li>
    <li class="breadcrumb-item active"><span>{{ Str::headline($subnombre) }}</span></li>


@endsection
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

    <script src="{{ url('js/subbucket.js?v=' . time()) }}"></script>



@endsection
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" d-flex align-items-center justify-content-between">
                                <h6 class="card-title align-middle pt-2">Bucket: <span
                                        class="fw-normal text-capitalize">{{ $nombre }}</span> / <span
                                        class="fw-normal text-capitalize">{{ $subnombre }}</span></h6>
                                <a href="{{ url('/subir/'. $nombre .'/'. $subnombre) }}" class="float-end btn btn-sm btn-success text-white outnone">Subir archivo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="subbuckets_table"
                                class="display table table-hover table-striped table-borderless outnone"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Última modificación</th>
                                        <th>Tamaño</th>
                                        <th>Clase de almacenamiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subbuckets as $sb)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="" id="">
                                            </td>
                                            <td>
                                                    <i class="fas fa-file"></i>
                                                    <a href="{{ url('shared/' . $sb->public_url) }}" target="_blank"
                                                        class="text-decoration-none">{{ $sb->name }}</a>
                                            </td>
                                            <td>
                                                @if ($sb->tipe === 'file' and $sb->isFolder === 0)
                                                    {{ $sb->ext }}
                                                @endif
                                            </td>
                                            <td>{{ $sb->updated_at->format('j M  Y g:i:s A T') }}</td>
                                            <td>{{ $sb->size }}</td>
                                            <td>{{ $sb->class }}</td>
                                            <td>
                                                    <a href="{{ url('shared/' . $sb->public_url) }}"
                                                        class="btn btn-dark text-white" target="_blank"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i
                                                            class="fas fa-eye"></i></a>

                                                    <a data-path="borrar/{{ Str::slug($nombre, '-') }}/{{ Str::slug($subnombre, '-') }}"
                                                        data-action="borrar" data-object="{{ $sb->id }}"
                                                        class="btn-deleted btn btn-danger text-white"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i
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
@endsection
