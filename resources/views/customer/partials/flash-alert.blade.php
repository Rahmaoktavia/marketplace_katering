@php
    $message = null;
    $type = null;
    $validationErrors = [];

    if ($errors->any()) {
        $type = 'error';
        $message = 'Periksa kembali data yang kamu masukkan.';
        $validationErrors = $errors->all();
    } elseif (session()->has('error')) {
        $type = 'error';
        $message = session('error');
    } elseif (session()->has('success')) {
        $type = session('success_type', 'success');
        $message = session('success');
    } elseif (session()->has('warning')) {
        $type = 'warning';
        $message = session('warning');
    } elseif (session()->has('info')) {
        $type = 'info';
        $message = session('info');
    }

    $styles = [
        'create' => [
            'class' => 'customer-flash-create',
            'icon' => 'bi-check-circle-fill',
            'title' => 'Berhasil ditambahkan!',
        ],
        'edit' => [
            'class' => 'customer-flash-edit',
            'icon' => 'bi-pencil-square',
            'title' => 'Berhasil diperbarui!',
        ],
        'delete' => [
            'class' => 'customer-flash-delete',
            'icon' => 'bi-trash3-fill',
            'title' => 'Berhasil dihapus!',
        ],
        'success' => [
            'class' => 'customer-flash-create',
            'icon' => 'bi-check-circle-fill',
            'title' => 'Berhasil!',
        ],
        'error' => [
            'class' => 'customer-flash-error',
            'icon' => 'bi-exclamation-circle-fill',
            'title' => 'Terjadi kesalahan!',
        ],
        'warning' => [
            'class' => 'customer-flash-warning',
            'icon' => 'bi-exclamation-triangle-fill',
            'title' => 'Perhatian!',
        ],
        'info' => [
            'class' => 'customer-flash-info',
            'icon' => 'bi-info-circle-fill',
            'title' => 'Informasi',
        ],
    ];

    $alert = $styles[$type] ?? $styles['success'];
@endphp

@if ($message)
    <div class="customer-flash {{ $alert['class'] }} alert-dismissible fade show"
         role="alert">

        <div class="customer-flash-icon">
            <i class="bi {{ $alert['icon'] }}"></i>
        </div>

        <div class="customer-flash-content">
            <strong>{{ $alert['title'] }}</strong>
            <p>{{ $message }}</p>

            @if (count($validationErrors))
                <ul class="mt-2 ps-3">
                    @foreach ($validationErrors as $validationError)
                        <li>{{ $validationError }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <button type="button"
                class="btn-close customer-flash-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>
    </div>
@endif