@extends('main')
@section('title', 'Mi perfil')
@section('breadcrumb', 'Mi perfil')
@section('custom_js')
    <script src="{{ url('js/show.js?v='.time()) }}"></script>
@endsection
@section('content')


{{-- @include('error') --}}
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Información del perfil</h6>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['url' => 'perfil', 'files' => false]) }}
                            {!! Form::hidden('id', $user->id, ['class'=>'form-control outnone', 'readonly']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" class="form-control outnone @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control outnone @error('email') is-invalid @enderror" readonly value="{{ $user->email }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="">Contraseña</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control outnone @error('password') is-invalid @enderror"
                                            placeholder="Ingrese la nueva clave" aria-label="password"
                                            aria-describedby="basic-addon1" name="password">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href=""><i class="fa fa-eye-slash text-dark"
                                                    aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Repetir contraseña</label>
                                    <div class="input-group" id="show_hide_re_password">
                                        <input type="password" class="form-control outnone @error('rpassword') is-invalid @enderror"
                                            placeholder="Repita la nueva clave" aria-label="password"
                                            aria-describedby="basic-addon1" name="rpassword">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href=""><i class="fa fa-eye-slash text-dark"
                                                    aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                    @error('rpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="">Key Id</label>
                                    <div class="input-group" id="show_hide_key_id">
                                        <input type="password" class="form-control outnone @error('key_id') is-invalid @enderror" name="key_id" readonly id="key_id" value="{{ $user->key_id }}">
                                        <span class="input-group-text" id="basic-addon1" >
                                            <a href="" id="a_show_key"><i class="fa fa-eye-slash text-dark" id="show_key"
                                                    aria-hidden="true"></i></a>
                                        </span>
                                        <span class="input-group-text" id="basic-addon1">
                                            <a  href="javascript:void(0);" class="text-decoration-none text-black" id="a_copy_key" data-clipboard-target="#key_id"  data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Copiar al portapapeles"><i class="fa fa-clipboard text-dark"
                                                    aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                    @error('key_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Access Key</label>
                                    <div class="input-group" id="show_hide_access_key">
                                        <input type="password" class="form-control outnone @error('access_key') is-invalid @enderror" name="access_key" id="access_key" readonly value="{{ $user->access_key }}">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="" id="a_show_access"><i class="fa fa-eye-slash text-dark" id="show_access"
                                                    aria-hidden="true"></i></a>
                                        </span>
                                        <span class="input-group-text" >
                                            <a href="javascript:void(0);" class="text-decoration-none" id="a_copy_access" data-clipboard-target="#access_key"><i class="fa fa-clipboard text-dark"
                                                    aria-hidden="true" id="copy_access"></i></a>
                                        </span>
                                    </div>
                                    @error('access_key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button class="outnone btn btn-block btn-success text-white float-end"
                                        type="submit">Guardar</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
