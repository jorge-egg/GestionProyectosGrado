@extends('emails.plantillaGeneral')



@section('contenido')
    <p>{{ $nombreIntegrante1 }} te ha invitado a unirte a su proyecto. Si no deseas unirte, por favor omita el correo.</p>
    <a href="{{$url}}" class="btn btn-primary">Aceptar</a><br>
@endsection
