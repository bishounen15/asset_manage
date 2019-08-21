{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Asset Type Maintenance')

@section('content_header')
    <h1><strong>Assets Master List</strong></h1>
@stop

@section('content')
    <div id="app">
        <asset-list></asset-list>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop