@php
    $flashMessage = null;
    $flashType = null;

    if (session()->has('error')) {
        $flashMessage = session('error');
        $flashType = 'error';
    } elseif (session()->has('success')) {
        $flashMessage = session('success');
        $flashType = session('success_type', 'success');
    } elseif (session()->has('warning')) {
        $flashMessage = session('warning');
        $flashType = 'warning';
    } elseif (session()->has('info')) {
        $flashMessage = session('info');
        $flashType = 'info';
    }

    $flashStyles = [
        'create' => [
            'class' => 'flash-create',
            'icon' => 'bi-check-circle-fill',
            'title' => 'Berhasil ditambahkan!',
        ],
        'edit' => [
            'class' => 'flash-edit',
            'icon' => 'bi-pencil-square',
            'title' => 'Berhasil diperbarui!',
        ],
        'delete' => [
            'class' => 'flash-delete',
            'icon' => 'bi-trash3-fill',
            'title' => 'Berhasil dihapus!',
        ],
        'success' => [
            'class' => 'flash-create',
            'icon' => 'bi-check-circle-fill',
            'title' => 'Berhasil!',
        ],
        'error' => [
            'class' => 'flash-delete',
            'icon' => 'bi-exclamation-circle-fill',
            'title' => 'Terjadi kesalahan!',
        ],
        'warning' => [
            'class' => 'flash-warning',
            'icon' => 'bi-exclamation-triangle-fill',
            'title' => 'Perhatian!',
        ],
        'info' => [
            'class' => 'flash-info',
            'icon' => 'bi-info-circle-fill',
            'title' => 'Informasi',
        ],
    ];

    $flash = $flashStyles[$flashType] ?? $flashStyles['success'];
@endphp

@if ($flashMessage)
    <div class="merchant-flash {{ $flash['class'] }} alert-dismissible fade show"
         role="alert">

        <div class="merchant-flash-icon">
            <i class="bi {{ $flash['icon'] }}"></i>
        </div>

        <div class="merchant-flash-content">
            <strong>{{ $flash['title'] }}</strong>
            <p>{{ $flashMessage }}</p>
        </div>

        <button type="button"
                class="btn-close merchant-flash-close"
                data-bs-dismiss="alert"
                aria-label="Tutup">
        </button>
    </div>
@endif
