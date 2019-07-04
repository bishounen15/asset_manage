{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Property Type Maintenance')

@section('content_header')
    <h1><strong>Property Type Maintenance</strong></h1>
@stop

@section('content')
    <div id="app">
        <proptype-dataset></proptype-dataset>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop