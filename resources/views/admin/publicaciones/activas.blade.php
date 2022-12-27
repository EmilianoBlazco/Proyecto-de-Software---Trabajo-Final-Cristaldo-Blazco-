@extends('adminlte::page')

@section('title', 'Easy-Rent')

@section('content_header')
    <h1>Publicaciones Activas</h1>
@stop

@section('content')


    <div class="card">

        @if($publicaciones->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Propietario</th>
                    <th>Fecha de Publicacion</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($publicaciones as $publicacion)
                    <tr>
                        <td>{{$publicacion->id}}</td>
                        <td>{{ $publicacion->titulo_publicacion }}</td>
                        <td>
                            @foreach($tiposPropiedades as $tipo)
                                @if($tipo->id == $publicacion->id_tipo_propiedad)
                                    {{$tipo->nombre_tipo_propiedad}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$publicacion->estado_publicacion}}</td>
                        <td>
                            @foreach($usuarios as $usuario)
                                @if($usuario->id == $publicacion->id_usuario)
                                    {{$usuario->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$publicacion->created_at->format('d-m-Y')}}</td>
                        <td width="10px">
                            <form action="{{route('admin.rating',$publicacion->id)}}" method="Get">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ">Ver comentarios</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>



@stop

