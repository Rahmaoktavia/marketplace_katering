@extends('merchant.layouts.main')

@section('title', 'Kategori Menu')

@section('content')
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1>Kategori Menu</h1>
        </div>

        <a href="{{ route('merchant.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="panel">
        {{-- Form pencarian --}}
        <form action="{{ route('merchant.categories.index') }}"
              method="GET"
              class="row g-2 mb-4">

            <div class="col-md-6 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama kategori..."
                        value="{{ $search ?? '' }}"
                    >
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </div>

            @if (!empty($search))
                <div class="col-auto">
                    <a href="{{ route('merchant.categories.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $loop->index }}</td>

                            <td class="fw-semibold">
                                {{ $category->nama_kategori }}
                            </td>

                            <td>{{ $category->deskripsi ?: '-' }}</td>

                            <td class="text-end">
                                <a href="{{ route('merchant.categories.edit', $category) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit kategori">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form id="delete-category-form-{{ $category->id }}"
                                    action="{{ route('merchant.categories.destroy', $category) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus kategori"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-form-id="delete-category-form-{{ $category->id }}"
                                            data-delete-name="{{ $category->nama_kategori }}"
                                            data-delete-type="kategori">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">
                                @if (!empty($search))
                                    Kategori dengan kata kunci "{{ $search }}" tidak ditemukan.
                                @else
                                    Belum ada kategori menu.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
