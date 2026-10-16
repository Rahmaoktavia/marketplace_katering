@extends('merchant.layouts.main')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-heading">
        <h1>Edit Kategori</h1>
        <p>Perbarui informasi kategori menu.</p>
    </div>

    <div class="panel">
        @include('merchant.categories._form', ['category' => $category])
    </div>
@endsection

