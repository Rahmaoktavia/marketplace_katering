<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Merchant') </title>
    <link rel="icon"type="image/x-icon"href="{{ asset('favicon/favicon.ico') }}?v=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2769a8;
            --primary-dark: #1f568b;
            --primary-light: #e8f3ff;
            --text: #243047;
            --muted: #687386;
            --border: #dce3ed;
            --surface: #ffffff;
            --page: #f5f8fc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--page);
            color: var(--text);
        }

        .merchant-app {
            min-height: 100vh;
        }

        .merchant-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 250px;
            overflow-y: auto;
            background: var(--surface);
            border-right: 1px solid var(--border);
            z-index: 1030;
        }

        .merchant-main {
            min-height: 100vh;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
        }

        .merchant-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 4px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .merchant-nav-link:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .merchant-nav-active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }


        .merchant-content {
            flex: 1;
            padding: 28px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: var(--muted);
            margin-bottom: 0;
            font-size: 14px;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        @media (max-width: 991.98px) {
            .merchant-sidebar {
                position: static;
                width: 100%;
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .merchant-main {
                margin-left: 0;
            }

            .merchant-content {
                padding: 20px 16px;
            }
        }

/* =========================
   HALAMAN INVOICE MERCHANT
========================= */

.merchant-invoice-page {
    color: #263244;
}

.merchant-invoice-page .invoice-page-heading h1 {
    color: #233b63;
}

.merchant-invoice-page .invoice-document {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 42px;
    background: #fff;
    border: 1px solid #e9edf3;
    border-radius: 14px;
    box-shadow: 0 4px 20px rgba(35, 59, 99, .06);
    box-sizing: border-box;
}

.merchant-invoice-page .invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 24px;
}

.merchant-invoice-page .invoice-brand {
    color: #233b63;
    font-size: 30px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.merchant-invoice-page .invoice-subtitle {
    margin-top: 8px;
    color: #7c8798;
    font-size: 13px;
}

.merchant-invoice-page .invoice-number-block {
    text-align: right;
    min-width: 0;
}

.merchant-invoice-page .invoice-number-block h2 {
    margin: 8px 0 12px;
    color: #233b63;
    font-size: 20px;
    font-weight: 750;
    overflow-wrap: anywhere;
}

.merchant-invoice-page .invoice-label {
    display: block;
    margin-bottom: 8px;
    color: #7c8798;
    font-size: 10px;
    font-weight: 750;
    letter-spacing: .7px;
}

.merchant-invoice-page .invoice-status {
    display: inline-block;
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 750;
    letter-spacing: .3px;
}

.merchant-invoice-page .status-paid {
    color: #146c43;
    background: #d1e7dd;
}

.merchant-invoice-page .status-failed {
    color: #b02a37;
    background: #f8d7da;
}

.merchant-invoice-page .status-pending {
    color: #997404;
    background: #fff3cd;
}

.merchant-invoice-page .invoice-divider {
    margin: 28px 0;
    border-top: 2px solid #233b63;
}

/* Informasi merchant dan customer */
.merchant-invoice-page .invoice-parties {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 40px;
    margin-bottom: 30px;
}

.merchant-invoice-page .invoice-party h3 {
    margin-bottom: 10px;
    color: #27374f;
    font-size: 15px;
    font-weight: 750;
    overflow-wrap: anywhere;
}

.merchant-invoice-page .invoice-party p {
    margin: 0 0 5px;
    color: #667085;
    font-size: 13px;
    line-height: 1.7;
    overflow-wrap: anywhere;
}

/* Informasi invoice */
.merchant-invoice-page .invoice-meta {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    padding: 20px;
    margin-bottom: 32px;
    background: #f7f9fc;
    border: 1px solid #edf0f5;
    border-radius: 8px;
}

.merchant-invoice-page .invoice-meta p {
    margin: 0;
    color: #303e53;
    font-size: 12px;
    font-weight: 650;
    overflow-wrap: anywhere;
}

/* Rincian menu */
.merchant-invoice-page .invoice-section-title {
    margin-bottom: 14px;
}

.merchant-invoice-page .invoice-section-title h3 {
    margin: 0 0 5px;
    color: #27374f;
    font-size: 17px;
    font-weight: 750;
}

.merchant-invoice-page .invoice-section-title p {
    margin: 0;
    color: #7c8798;
    font-size: 12px;
}

.merchant-invoice-page .invoice-table {
    width: 100%;
    margin-bottom: 0;
    color: #263244;
    font-size: 12px;
    border-color: #e9edf3;
}

.merchant-invoice-page .invoice-table thead th {
    padding: 13px 10px;
    color: #526078;
    background: #f5f7fa;
    border-bottom: 1px solid #dfe5ed;
    font-size: 10px;
    letter-spacing: .4px;
    text-transform: uppercase;
    white-space: nowrap;
}

.merchant-invoice-page .invoice-table tbody td {
    padding: 15px 10px;
    vertical-align: middle;
}

.merchant-invoice-page .invoice-menu-name {
    color: #303e53;
    font-weight: 650;
}

/* Total tagihan */
.merchant-invoice-page .invoice-total-section {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(260px, 350px);
    gap: 30px;
    margin-top: 28px;
    padding-bottom: 28px;
    border-bottom: 1px solid #e9edf3;
}

.merchant-invoice-page .invoice-total-note p {
    margin-bottom: 8px;
    color: #758095;
    font-size: 12px;
    line-height: 1.7;
}

.merchant-invoice-page .invoice-total-note .invoice-payment-method {
    color: #526078;
    overflow-wrap: anywhere;
}

.merchant-invoice-page .invoice-total-row {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 14px;
    font-size: 12px;
}

.merchant-invoice-page .invoice-total-row span:last-child {
    text-align: right;
    font-weight: 650;
}

.merchant-invoice-page .invoice-grand-total {
    padding: 17px;
    background: #f3f6fb;
    border-left: 3px solid #263f68;
    border-radius: 4px;
}

.merchant-invoice-page .invoice-grand-total span {
    display: block;
    margin-bottom: 8px;
    color: #64718a;
    font-size: 10px;
    font-weight: 750;
    letter-spacing: .6px;
}

.merchant-invoice-page .invoice-grand-total strong {
    display: block;
    color: #233b63;
    font-size: 22px;
    overflow-wrap: anywhere;
}

/* Tombol aksi */
.merchant-invoice-page .invoice-actions {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid #e9edf3;
}

/* Responsif */
@media screen and (max-width: 700px) {
    .merchant-invoice-page .invoice-document {
        padding: 22px 16px;
        border-radius: 10px;
    }

    .merchant-invoice-page .invoice-header {
        flex-direction: column;
    }

    .merchant-invoice-page .invoice-number-block {
        text-align: left;
    }

    .merchant-invoice-page .invoice-parties {
        grid-template-columns: minmax(0, 1fr);
        gap: 22px;
    }

    .merchant-invoice-page .invoice-meta {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 12px;
        padding: 15px;
    }

    .merchant-invoice-page .invoice-total-section {
        grid-template-columns: minmax(0, 1fr);
    }

    .merchant-invoice-page .invoice-actions {
        flex-direction: column-reverse;
    }

    .merchant-invoice-page .invoice-actions .btn {
        width: 100%;
    }

    .merchant-invoice-page .invoice-table thead th {
        white-space: normal;
    }
}

/* Cetak invoice / simpan PDF */
@media print {
    @page {
        size: A4;
        margin: 12mm;
    }

    body * {
        visibility: hidden !important;
    }

    .merchant-invoice-page .invoice-document,
    .merchant-invoice-page .invoice-document * {
        visibility: visible !important;
    }

    .merchant-invoice-page .invoice-document {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        background: #fff !important;
    }

    .no-print,
    .invoice-actions,
    .invoice-page-heading {
        display: none !important;
    }

    .merchant-invoice-page .invoice-table-wrapper {
        overflow: visible !important;
    }

    .merchant-invoice-page .invoice-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .merchant-invoice-page .invoice-table thead {
        display: table-header-group;
    }

    .merchant-invoice-page .invoice-table tr,
    .merchant-invoice-page .invoice-header,
    .merchant-invoice-page .invoice-parties,
    .merchant-invoice-page .invoice-meta,
    .merchant-invoice-page .invoice-total-section {
        break-inside: avoid;
        page-break-inside: avoid;
    }

    .merchant-invoice-page .invoice-table thead th {
        background: #f5f7fa !important;
        color: #526078 !important;
    }

    .merchant-invoice-page .invoice-grand-total {
        background: #f3f6fb !important;
    }

    .merchant-invoice-page .invoice-document,
    .merchant-invoice-page .invoice-document * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .merchant-invoice-page .invoice-document a {
        color: inherit !important;
        text-decoration: none !important;
    }
    }
    /* Modal konfirmasi logout */
    .logout-modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(25, 25, 25, 0.12);
    }

    .logout-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #f8edf0;
        color: #dc3545;
        font-size: 25px;
    }

    .logout-modal-title {
        color: #292929;
        font-size: 20px;
        font-weight: 600;
    }

    .logout-modal-text {
        color: #777;
        font-size: 14px;
        line-height: 1.7;
    }

    .logout-cancel-btn,
    .logout-confirm-btn {
        min-width: 110px;
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .logout-cancel-btn {
        color: #555;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
    }

    .logout-cancel-btn:hover {
        background: #e9eaed;
        color: #333;
    }

    .logout-confirm-btn {
        color: #fff;
        background: #dc3545;
        border: 1px solid #dc3545;
    }

    .logout-confirm-btn:hover {
        color: #fff;
        background: #dc3545;
        border-color: #dc3545;
    }

    @media (max-width: 576px) {
        .logout-modal-content {
            border-radius: 14px;
        }
    }

        .confirm-modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 16px 48px rgba(36, 48, 71, 0.14);
        }

        .confirm-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #fff0f0;
            color: #dc3545;
            font-size: 24px;
        }

        .confirm-modal-title {
            color: #243047;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.5;
        }

        .confirm-modal-text {
            color: #687386;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.8;
        }

        .confirm-modal-text strong {
            color: #243047;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .confirm-cancel-btn,
        .confirm-delete-btn {
            min-width: 110px;
            padding: 10px 18px;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease;
        }

        .confirm-cancel-btn {
            color: #526078;
            background: #f5f7fa;
            border: 1px solid #dce3ed;
        }

        .confirm-cancel-btn:hover {
            color: #243047;
            background: #e9edf3;
            border-color: #dce3ed;
        }

        .confirm-delete-btn {
            color: #fff;
            background: #dc3545;
            border: 1px solid #dc3545;
        }

        .confirm-delete-btn:hover {
            color: #fff;
            background: #bb2d3b;
            border-color: #bb2d3b;
        }

        @media (max-width: 576px) {
            .confirm-modal-content {
                border-radius: 14px;
            }

            .confirm-modal-title {
                font-size: 18px;
            }

            .confirm-cancel-btn,
            .confirm-delete-btn {
                min-width: 100px;
                padding: 10px 14px;
            }
        }

        .merchant-flash {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        position: relative;
        padding: 16px 46px 16px 16px;
        margin-bottom: 22px;
        border: 1px solid transparent;
        border-left: 4px solid;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        animation: flash-appear 0.25s ease-out;
        }

        .merchant-flash-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 10px;
            font-size: 17px;
        }

        .merchant-flash-content {
            flex: 1;
            min-width: 0;
            padding-top: 1px;
        }

        .merchant-flash-content strong {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 600;
        }

        .merchant-flash-content p {
            margin: 0;
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .merchant-flash-close {
            position: absolute;
            top: 17px;
            right: 16px;
            padding: 5px;
            font-size: 10px;
        }

        /* Create: hijau */
        .flash-create {
            color: #17663a;
            background: #eff9f2;
            border-color: #ccebd5;
            border-left-color: #198754;
        }

        .flash-create .merchant-flash-icon {
            background: #d9f1e1;
            color: #198754;
        }

        /* Edit: biru */
        .flash-edit {
            color: #174b91;
            background: #eff6ff;
            border-color: #d2e5ff;
            border-left-color: #2769a8;
        }

        .flash-edit .merchant-flash-icon {
            background: #dcecff;
            color: #2769a8;
        }

        /* Delete: merah */
        .flash-delete {
            color: #a52834;
            background: #fff1f1;
            border-color: #f5d0d3;
            border-left-color: #dc3545;
        }

        .flash-delete .merchant-flash-icon {
            background: #ffdddd;
            color: #dc3545;
        }

        /* Warning: kuning */
        .flash-warning {
            color: #805b08;
            background: #fff9e8;
            border-color: #f3e3ae;
            border-left-color: #d99a00;
        }

        .flash-warning .merchant-flash-icon {
            background: #fff0bd;
            color: #b58100;
        }

        /* Info: biru muda */
        .flash-info {
            color: #24556f;
            background: #eff9ff;
            border-color: #d0eaf7;
            border-left-color: #0d9ac4;
        }

        .flash-info .merchant-flash-icon {
            background: #d9f2ff;
            color: #0d83aa;
        }

        @keyframes flash-appear {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .merchant-flash {
                gap: 10px;
                padding: 13px 38px 13px 12px;
                margin-bottom: 18px;
            }

            .merchant-flash-icon {
                width: 32px;
                height: 32px;
                flex-basis: 32px;
                font-size: 15px;
            }

            .merchant-flash-content strong {
                font-size: 12px;
            }

            .merchant-flash-content p {
                font-size: 11px;
            }

            .merchant-flash-close {
                top: 13px;
                right: 10px;
            }
        }

        .pagination {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 0;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 6px 11px;
            margin-left: 0;
            border: 1px solid #dce3ed;
            border-radius: 8px !important;
            background: #ffffff;
            color: #2769a8;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            box-shadow: none;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease,
                        color 0.2s ease;
        }

        .pagination .page-link:hover {
            z-index: 2;
            border-color: #c5dbf3;
            background: #e8f3ff;
            color: #1f568b;
        }

        .pagination .page-item.active .page-link {
            border-color: #2769a8;
            background: #2769a8;
            color: #ffffff;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            border-color: #e3eaf2;
            background: #f8fafc;
            color: #a0a9b7;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.15rem rgba(39, 105, 168, 0.15);
        }

        @media (max-width: 575.98px) {
            .pagination {
                gap: 4px;
                justify-content: center;
            }

            .pagination .page-link {
                min-width: 32px;
                height: 34px;
                padding: 5px 9px;
                font-size: 11px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="merchant-app">
        @include('merchant.layouts.sidebar')

        <div class="merchant-main">
            @include('merchant.layouts.header')

        <main class="merchant-content">
            @include('merchant.partials.flash-alert')

            @yield('content')
        </main>

            @include('merchant.layouts.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('deleteConfirmModal');
            const nameElement = document.getElementById('deleteConfirmName');
            const typeElement = document.getElementById('deleteConfirmType');
            const confirmButton = document.getElementById('confirmDeleteButton');

            let selectedFormId = null;

            if (!modal || !nameElement || !typeElement || !confirmButton) {
                return;
            }

            modal.addEventListener('show.bs.modal', function (event) {
                const triggerButton = event.relatedTarget;

                selectedFormId = triggerButton.dataset.formId;
                nameElement.textContent = '"' + triggerButton.dataset.deleteName + '"';
                typeElement.textContent = triggerButton.dataset.deleteType;
            });

            confirmButton.addEventListener('click', function () {
                const form = selectedFormId
                    ? document.getElementById(selectedFormId)
                    : null;

                if (form) {
                    form.submit();
                }
            });

            modal.addEventListener('hidden.bs.modal', function () {
                selectedFormId = null;
            });
        });
    </script>
    @stack('scripts')
    {{-- Modal Konfirmasi Hapus Bersama --}}
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1"
        aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content confirm-modal-content">
                <div class="modal-body p-4 p-md-5 text-center">

                    <div class="confirm-icon mb-4">
                        <i class="bi bi-trash3"></i>
                    </div>

                    <h5 class="confirm-modal-title mb-2"
                        id="deleteConfirmModalLabel">
                        Hapus data?
                    </h5>

                    <p class="confirm-modal-text mb-4">
                        Apakah kamu yakin ingin menghapus
                        <span id="deleteConfirmType">data</span>
                        <strong id="deleteConfirmName">ini</strong>?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button"
                                class="btn confirm-cancel-btn"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="button"
                                class="btn confirm-delete-btn"
                                id="confirmDeleteButton">
                            Ya, Hapus
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
