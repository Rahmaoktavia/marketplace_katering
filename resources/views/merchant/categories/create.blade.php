@extends('merchant.layouts.main')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="page-heading">
        <h1>Tambah Kategori</h1>
        <p>Tambahkan kategori baru untuk menu katering.</p>
    </div>

    <div class="panel">
        @include('merchant.categories._form', ['category' => null])
    </div>
@endsection

