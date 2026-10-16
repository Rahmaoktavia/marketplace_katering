@extends('merchant.layouts.main')

@section('title', 'Edit Menu')

@section('content')
    <div class="page-heading">
        <h1>Edit Menu Katering</h1>
        <p>Perbarui informasi, harga, foto, atau ketersediaan menu.</p>
    </div>

    <div class="panel">
        @include('merchant.menus._form', ['menu' => $menu])
    </div>
@endsection

