
<h1>{{$modo}} jugador</h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="Nombre"> Nombre </label>
    <input type="text" class="form-control" name="Nombre" value="{{ isset($jugador->Nombre)? $jugador->Nombre:old('Nombre') }}" id="Nombre">
    </div>

    <div class="form-group">
    <label for="ApellidoPaterno"> Apellido Paterno </label>
    <input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset($jugador->ApellidoPaterno)? $jugador->ApellidoPaterno:old('ApellidoPaterno') }}" id="ApellidoPaterno">
    </div>

    <div class="form-group">
    <label for="ApellidoMaterno"> Apellido Materno </label>
    <input type="text" class="form-control" name="ApellidoMaterno" value="{{ isset($jugador->ApellidoMaterno)? $jugador->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
    </div>

    <div class="form-group">
    <label for="Correo"> Correo </label>
    <input type="text" class="form-control" name="Correo" value="{{ isset($jugador->Correo)? $jugador->Correo:old('Correo') }}" id="Correo">
    </div>

    <div class="form-group">
    <label for="Foto"></label>
    @if (isset($jugador->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$jugador->Foto }}" width="100" alt=""/>
    @endif
    </div>
    <input type="file" class="form-control" name="Foto" value="" id="Foto">
    <br>
    <input class="btn btn-success" type="submit" value="{{ $modo }} datos"/>
    <a class="btn btn-primary" href="{{ url('jugador/') }}"> 
    Regresar 
    </a>