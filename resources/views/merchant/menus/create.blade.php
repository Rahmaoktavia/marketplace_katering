@extends('merchant.layouts.main')

@section('title', 'Tambah Menu')

@section('content')
    <div class="page-heading">
        <h1>Tambah Menu Katering</h1>
        <p>Tambahkan hidangan baru ke daftar menu usaha kamu.</p>
    </div>

    <div class="panel">
        @include('merchant.menus._form', ['menu' => null])
    </div>
@endsection

