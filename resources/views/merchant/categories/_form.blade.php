<form action="{{ isset($category) && $category
    ? route('merchant.categories.update', $category)
    : route('merchant.categories.store') }}" method="POST">

    @csrf

    @if (isset($category) && $category)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="nama_kategori" class="form-label">
            Nama Kategori <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nama_kategori"
            id="nama_kategori"
            class="form-control @error('nama_kategori') is-invalid @enderror"
            value="{{ old('nama_kategori', $category->nama_kategori ?? '') }}"
            placeholder="Contoh: Paket Nasi"
            maxlength="100"
            required
        >

        @error('nama_kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="form-label">Deskripsi</label>

        <textarea
            name="deskripsi"
            id="deskripsi"
            rows="3"
            class="form-control @error('deskripsi') is-invalid @enderror"
            placeholder="Keterangan kategori (opsional)"
        >{{ old('deskripsi', $category->deskripsi ?? '') }}</textarea>

        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('merchant.categories.index') }}"
           class="btn btn-outline-secondary">Batal</a>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Simpan
        </button>
    </div>
</form>

