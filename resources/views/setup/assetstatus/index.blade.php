{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Asset Status Maintenance')

@section('content_header')
    <h1><strong>Asset Status Maintenance</strong></h1>
@stop

@section('content')
    <div id="app">
        <assetstatus-dataset></assetstatus-dataset>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop