@extends('merchant.layouts.main')

@section('title', 'Menu Katering')

@section('content')
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1>Menu Katering</h1>
        </div>

        <a href="{{ route('merchant.menus.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Menu
        </a>
    </div>

    <div class="panel">
        {{-- Form pencarian --}}
        <form action="{{ route('merchant.menus.index') }}"
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
                        placeholder="Cari nama menu atau kategori..."
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
                    <a href="{{ route('merchant.menus.index') }}"
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
                        <th>Foto</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($menus as $menu)
                        <tr>
                            <td>
                                @if ($menu->foto)
                                    <img src="{{ asset('storage/' . $menu->foto) }}"
                                         alt="{{ $menu->nama_menu }}"
                                         width="64"
                                         height="52"
                                         class="rounded object-fit-cover">
                                @else
                                    <span class="text-secondary">Tidak ada foto</span>
                                @endif
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $menu->nama_menu }}</div>
                                <small class="text-secondary">
                                    {{ \Illuminate\Support\Str::limit($menu->deskripsi, 55) }}
                                </small>
                            </td>

                            <td>{{ $menu->category->nama_kategori ?? '-' }}</td>

                            <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>

                            <td>
                                @if ($menu->tersedia)
                                    <span class="badge text-bg-success">Tersedia</span>
                                @else
                                    <span class="badge text-bg-secondary">Tidak tersedia</span>
                                @endif
                            </td>

                            <td class="text-end text-nowrap">
                                <a href="{{ route('merchant.menus.edit', $menu) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit menu">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form id="delete-menu-form-{{ $menu->id }}"
                                    action="{{ route('merchant.menus.destroy', $menu) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus menu"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-form-id="delete-menu-form-{{ $menu->id }}"
                                            data-delete-name="{{ $menu->nama_menu }}"
                                            data-delete-type="menu">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-secondary">
                                @if (!empty($search))
                                    Menu dengan kata kunci "{{ $search }}" tidak ditemukan.
                                @else
                                    Belum ada menu katering.
                                    <div class="mt-2">
                                        <a href="{{ route('merchant.menus.create') }}">
                                            Tambah menu pertama
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
