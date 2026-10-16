<form
    action="{{ isset($menu) && $menu
        ? route('merchant.menus.update', $menu)
        : route('merchant.menus.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @if (isset($menu) && $menu)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="nama_menu" class="form-label">
            Nama Menu <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            name="nama_menu"
            id="nama_menu"
            class="form-control @error('nama_menu') is-invalid @enderror"
            value="{{ old('nama_menu', $menu->nama_menu ?? '') }}"
            maxlength="150"
            required
        >
        @error('nama_menu')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="menu_category_id" class="form-label">
            Kategori <span class="text-danger">*</span>
        </label>
        <select
            name="menu_category_id"
            id="menu_category_id"
            class="form-select @error('menu_category_id') is-invalid @enderror"
            required>
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('menu_category_id', $menu->menu_category_id ?? '') == $category->id)>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('menu_category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($categories->isEmpty())
            <small class="text-danger">
                Belum ada kategori. Tambahkan kategori terlebih dahulu.
            </small>
        @endif
    </div>

    <div class="mb-4">
        <label for="harga" class="form-label">
            Harga per Porsi (Rp) <span class="text-danger">*</span>
        </label>
        <input
            type="number"
            name="harga"
            id="harga"
            class="form-control @error('harga') is-invalid @enderror"
            value="{{ old('harga', $menu->harga ?? '') }}"
            min="0"
            step="0.01"
            required
        >
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="form-label">
            Deskripsi Menu <span class="text-danger">*</span>
        </label>
        <textarea
            name="deskripsi"
            id="deskripsi"
            rows="4"
            class="form-control @error('deskripsi') is-invalid @enderror"
            required
        >{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="foto" class="form-label">
            Foto Menu
            @if (!isset($menu) || !$menu)
                <span class="text-danger">*</span>
            @endif
        </label>
        <input
            type="file"
            name="foto"
            id="foto"
            accept=".jpg,.jpeg,.png,.webp"
            class="form-control @error('foto') is-invalid @enderror"
            @required(!isset($menu) || !$menu)
        >
        <small class="text-secondary">Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</small>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if (isset($menu) && $menu && $menu->foto)
            <div class="mt-3">
                <img src="{{ asset('storage/' . $menu->foto) }}"
                     alt="{{ $menu->nama_menu }}"
                     width="150" class="rounded">
                <div class="small text-secondary mt-1">Foto saat ini</div>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label for="tersedia" class="form-label">Ketersediaan Menu</label>
        <select
            name="tersedia"
            id="tersedia"
            class="form-select @error('tersedia') is-invalid @enderror"
            required>
            <option value="1" @selected((string) old('tersedia', isset($menu) ? (int) $menu->tersedia : 1) === '1')>
                Tersedia
            </option>
            <option value="0" @selected((string) old('tersedia', isset($menu) ? (int) $menu->tersedia : 1) === '0')>
                Tidak tersedia
            </option>
        </select>
        @error('tersedia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('merchant.menus.index') }}"
           class="btn btn-outline-secondary">Batal</a>

        <button type="submit" class="btn btn-primary"
                @disabled($categories->isEmpty())>
            <i class="bi bi-save me-1"></i> Simpan Menu
        </button>
    </div>
</form>
