{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Asset Profile')

@section('content_header')
    <h1><strong>Asset Profile</strong></h1>
@stop

@section('content')
    <div id="app">
        <asset-profile
         v-bind:asset_id=1
        ></asset-profile>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop