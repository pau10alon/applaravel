@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<a href="{{ url('jugador/create') }}" class="btn btn-success"> Registrar nuevo jugador </a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($jugadors as $jugador)
        <tr>
            <td>{{$jugador->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$jugador->Foto }}" width="100" alt="">
            </td>
            <td>{{$jugador->Nombre}}</td>
            <td>{{$jugador->ApellidoPaterno}}</td>
            <td>{{$jugador->ApellidoMaterno}}</td>
            <td>{{$jugador->Correo}}</td>
            <td>   
            <a href="{{ url('/jugador/'.$jugador->id.'/edit') }}" class="btn btn-warning">
                Editar
            </a>
             | 
            <form action="{{ url('/jugador/'.$jugador->id) }}" class="d-inline" method="post">
             @csrf
             {{ method_field('DELETE') }}   
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿quieres borrar?')"
                value="Borrar">
            </form>   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $jugadors->links() !!}
</div>
@endsection