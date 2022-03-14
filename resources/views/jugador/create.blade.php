@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/jugador') }}"  method="post" enctype="multipart/form-data">
@csrf
@include('jugador.form', ['modo'=>'Crear']);

</form>
</div>
@endsection
