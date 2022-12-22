@extends('adminlte::page')

@section('title', 'Easy-Rent')

@section('content_header')
    <h1>Registros de actividad</h1>
@stop

@section('content')

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <input wire:model="search" class="form-control" placeholder="Ingrese nombre de usuario o email para buscar">
            </div>
            <div>
                <a href="{{route('auditoria.pdf')}}" class="btn btn-primary" target="_blank" >Generar PDF</a>
            </div>
        </div>
    </div>

    <div class="card">

        @if($auditorias->count())
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                <tr class="text-center">
{{--                    <th>ID</th>--}}
                    <th>Nombre</th>
{{--                    <th>Id del usuario</th>--}}
                    <th>Tipo de Usuario</th>
                    <th>Accion realizada</th>
                    <th>Fecha y hora</th>
                    <th>Modelo</th>
                    <th></th>
{{--                    Agregar boton para mostrar mas info--}}
{{--                    <th>Informacion Antigua</th>--}}
{{--                    <th>Informacion Nueva</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($auditorias as $auditoria)
                    <tr class="text-center">
{{--                        <td>{{$auditoria->id}}</td>--}}
                        <td>{{$auditoria->user->name}}</td>
{{--                        <td >{{$auditoria->user_id}}</td>--}}
                        <td>{{$auditoria->user->roles->pluck('name')->implode(', ')}}</td>
                        <td>{{__($auditoria->event)}}</td>
                        <td>{{$auditoria->created_at->format('d-m-Y // H:i' )}}</td>
                        <td> {{substr($auditoria->auditable_type,11)}}   </td>
                        <td>
{{--                            boton de accion "ver mas"--}}
                            <a href="{{route('admin.auditoriamas',$auditoria)}}" class="btn btn-sm btn-primary">Ver mas</a>

{{--                            @foreach($auditoria->old_values as $old_value)--}}
{{--                                *{{$old_value}}<br>--}}
{{--                            @endforeach--}}
{{--                                {{$auditoria->old_values['titulo_publicacion']}}--}}
{{--                            {{json_encode($auditoria->old_values->titulo_publicacion)}}--}}
{{--                            {{$auditoria->old_values->descripcion_publicacion}}--}}
{{--                            {{$auditoria->old_values->precio_publicacion}}--}}
{{--                            {{$auditoria->old_values->direccion_publicacion}}--}}
{{--                            {{$auditoria->old_values->tipo_publicacion}}--}}
{{--                            {{$auditoria->old_values->estado_publicacion}}--}}
{{--                            {{$auditoria->old_values->ciudad_publicacion}}--}}
{{--                            {{$auditoria->old_values->comuna_publicacion}}--}}
{{--                            {{$auditoria->old_values->habitaciones_publicacion}}--}}
{{--                            {{$auditoria->old_values->banos_publicacion}}--}}
{{--                            {{$auditoria->old_values->superficie_publicacion}}--}}
{{--                            {{$auditoria->old_values->estacionamientos_publicacion}}--}}
{{--                            {{$auditoria->old_values->latitud_publicacion}}--}}
{{--                            {{$auditoria->old_values->longitud_publicacion}}--}}
{{--                            {{$auditoria->old_values->user_id}}--}}
                        </td>
                        <td>
{{--                            @foreach($auditoria->new_values as $new_value)--}}
{{--                                *{{$new_value}}<br>--}}
{{--                            @endforeach--}}
                        </td>
{{--                        <td width="10px">--}}
{{--                            <form action="{{route('publicaciones.borrado.destroy',$publicacion->id)}}" method="POST">--}}
{{--                                @csrf--}}
{{--                                @method('delete')--}}
{{--                                <button type="submit" class="btn btn-danger btn-sm ">Eliminar permanentemente</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
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

