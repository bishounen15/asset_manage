{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'User Maintenance')

@section('content_header')
    <h1><strong>User Maintenance</strong></h1>
@stop

@section('content')
    <div id="app">
        <user-dataset></user-dataset>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop