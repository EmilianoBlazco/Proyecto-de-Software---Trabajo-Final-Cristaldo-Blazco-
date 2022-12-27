@extends('adminlte::page')

@section('title', 'Easy-Rent')

@section('content_header')
    <h1>Calificaciones y Comentarios de la Publicacion {{$publicacion->titulo_publicacion}}</h1>

@stop

@section('content')


    <div class="card">

        @if($ratings->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Calificacion</th>
                    <th>Comentario</th>
                    <th>Comentador</th>
                    <th>Fecha de Publicacion</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{$rating->id}}</td>
                        <td>{{$rating->calificacion}}</td>
                        <td>{{$rating->comentario}}</td>
                        <td>
                            @foreach($usuarios as $usuario)
                                @if($usuario->id == $rating->id_usuario)
                                    {{$usuario->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$rating->created_at->format('d-m-Y')}}</td>
                        <td width="10px">
{{--                            formualrio para cambiar de estado el comentario--}}


                            <form action="{{route('admin.rating.update',$rating->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm ">Deshabilitar</button>
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

