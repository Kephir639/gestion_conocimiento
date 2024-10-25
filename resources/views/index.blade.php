@extends('layouts.plantillaIndex')

@section('title', 'Inicio')

@section('content')

    <div>
        <span>Bienvenid@ {{ Auth::user()->name }} {{ Auth::user()->apellidos }}</span>
    </div>


@endsection
