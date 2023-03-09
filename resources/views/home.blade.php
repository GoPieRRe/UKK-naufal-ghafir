@extends('layouts.master')

@section('content')
<div class="card-header">Welcome {{ auth()->user()->name }}</div>
<div class="card-body">
    <h1 class="text-center">Welcome</h1>
    <h1 class="text-center">To</h1>
    <h1 class="text-center">Aplikasi Spp</h1>
</div>
@endsection
