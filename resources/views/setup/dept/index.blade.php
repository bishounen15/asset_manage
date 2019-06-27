{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Department Maintenance')

@section('content_header')
    <h1><strong>Department Maintenance</strong></h1>
@stop

@section('content')
    <div id="app">
        <dept-dataset></dept-dataset>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop