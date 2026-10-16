<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Marketplace Katering') </title>
    <link rel="icon"type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}?v=1">

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
            --page: #f5f8fc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: var(--page);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .customer-content {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .panel {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        @media (max-width: 575.98px) {
            .customer-content {
                padding: 24px 16px;
            }

            .page-heading h1 {
                font-size: 25px;
            }
        }
        .invoice-document {
        max-width: 1000px;
        margin: 0 auto;
        padding: 42px;
        background: #fff;
        border: 1px solid #e8ebf0;
        border-radius: 12px;
        color: #263244;
        box-shadow: 0 8px 30px rgba(24, 39, 75, 0.05);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
    }

    .invoice-brand {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: 2px;
        color: #233b63;
    }

    .invoice-subtitle {
        margin-top: 6px;
        color: #778195;
        font-size: 13px;
    }

    .invoice-number-block {
        text-align: right;
        min-width: 0;
    }

    .invoice-label {
        display: block;
        margin-bottom: 8px;
        color: #7c8798;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .invoice-number-block h2 {
        margin: 0 0 12px;
        font-size: 18px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    /* =========================
       STATUS PEMBAYARAN
    ========================= */

    .invoice-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .invoice-status.status-paid {
        color: #147d55;
        background: #e8f7ef;
    }

    .invoice-status.status-pending {
        color: #956400;
        background: #fff5d8;
    }

    .invoice-status.status-failed {
        color: #b42332;
        background: #fdebed;
    }

    .invoice-divider {
        height: 2px;
        margin: 28px 0;
        background: #263f68;
    }

    /* =========================
       MERCHANT DAN CUSTOMER
    ========================= */

    .invoice-parties {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 40px;
        margin-bottom: 30px;
    }

    .invoice-party h3 {
        margin-bottom: 10px;
        font-size: 15px;
        font-weight: 750;
        color: #27374f;
        overflow-wrap: anywhere;
    }

    .invoice-party p {
        margin: 0 0 5px;
        color: #667085;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    /* =========================
       INFORMASI INVOICE
    ========================= */

    .invoice-meta {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        padding: 20px;
        margin-bottom: 32px;
        background: #f7f9fc;
        border: 1px solid #edf0f5;
        border-radius: 8px;
    }

    .invoice-meta p {
        margin: 0;
        font-size: 12px;
        font-weight: 650;
        overflow-wrap: anywhere;
    }

    /* =========================
       RINCIAN MENU
    ========================= */

    .invoice-section-title {
        margin-bottom: 14px;
    }

    .invoice-section-title h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 750;
    }

    .invoice-section-title p {
        margin: 0;
        color: #7c8798;
        font-size: 12px;
    }

    .invoice-table {
        width: 100%;
        margin-bottom: 0;
        color: #263244;
        font-size: 12px;
        border-color: #e9edf3;
    }

    .invoice-table thead th {
        padding: 13px 10px;
        color: #526078;
        background: #f5f7fa;
        border-bottom: 1px solid #dfe5ed;
        font-size: 10px;
        letter-spacing: .4px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .invoice-table tbody td {
        padding: 15px 10px;
        vertical-align: middle;
    }

    .invoice-menu-name {
        font-weight: 650;
        color: #303e53;
    }

    /* =========================
       TOTAL TAGIHAN
    ========================= */

    .invoice-total-section {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(260px, 350px);
        gap: 30px;
        margin-top: 28px;
        padding-bottom: 28px;
        border-bottom: 1px solid #e9edf3;
    }

    .invoice-total-note p {
        margin-bottom: 8px;
        color: #758095;
        font-size: 12px;
        line-height: 1.7;
    }

    .invoice-total-note .invoice-payment-method {
        color: #526078;
        overflow-wrap: anywhere;
    }

    .invoice-total-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 14px;
        font-size: 12px;
    }

    .invoice-total-row span:last-child {
        text-align: right;
        font-weight: 650;
    }

    .invoice-grand-total {
        padding: 17px;
        background: #f3f6fb;
        border-left: 3px solid #263f68;
        border-radius: 4px;
    }

    .invoice-grand-total span {
        display: block;
        margin-bottom: 8px;
        color: #64718a;
        font-size: 10px;
        font-weight: 750;
        letter-spacing: .6px;
    }

    .invoice-grand-total strong {
        display: block;
        color: #233b63;
        font-size: 22px;
        overflow-wrap: anywhere;
    }

    .invoice-footer-note {
        padding-top: 24px;
        text-align: center;
    }

    .invoice-footer-note strong {
        font-size: 13px;
    }

    .invoice-footer-note p {
        margin: 6px 0 12px;
        color: #7c8798;
        font-size: 11px;
    }

    .invoice-footer-note span {
        color: #526078;
        font-size: 11px;
        font-weight: 750;
    }

    .invoice-actions {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #e9edf3;
    }

    @media screen and (max-width: 700px) {
        .invoice-document {
            padding: 22px 16px;
        }

        .invoice-header {
            flex-direction: column;
        }

        .invoice-number-block {
            text-align: left;
        }

        .invoice-parties {
            grid-template-columns: minmax(0, 1fr);
            gap: 22px;
        }

        .invoice-meta {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px 12px;
            padding: 15px;
        }

        .invoice-total-section {
            grid-template-columns: minmax(0, 1fr);
        }

        .invoice-actions {
            flex-direction: column-reverse;
        }

        .invoice-actions .btn {
            width: 100%;
        }

        .invoice-table thead th {
            white-space: normal;
        }
    }

    @media print {
        @page {
            size: A4;
            margin: 12mm;
        }

        html,
        body {
            width: 100% !important;
            height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            color: #263244 !important;
            font-size: 11px !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /*
         * Sembunyikan semua elemen halaman,
         * lalu tampilkan hanya dokumen invoice.
         */
        body * {
            visibility: hidden !important;
        }

        .invoice-document,
        .invoice-document * {
            visibility: visible !important;
        }

        .invoice-document {
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

        /* Hilangkan tombol dan heading halaman. */
        .no-print,
        .invoice-actions,
        .invoice-page-heading {
            display: none !important;
        }

        .invoice-table-wrapper {
            width: 100% !important;
            overflow: visible !important;
        }

        .invoice-table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        .invoice-table thead {
            display: table-header-group;
        }

        .invoice-table tfoot {
            display: table-row-group;
        }

        .invoice-table tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .invoice-header,
        .invoice-parties,
        .invoice-meta,
        .invoice-total-section,
        .invoice-footer-note {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .invoice-document,
        .invoice-document * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .invoice-table thead th {
            background: #f5f7fa !important;
            color: #526078 !important;
        }

        .invoice-grand-total {
            background: #f3f6fb !important;
        }

        a {
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

    .customer-navbar {
        background: #ffffff;
        border-bottom: 1px solid #e4eaf2;
        box-shadow: 0 2px 12px rgba(36, 48, 71, 0.025);
        z-index: 1020;
    }

    .customer-brand {
        margin-right: 0;
        padding: 8px 0;
    }

    .customer-brand-icon {
        width: 42px;
        height: 42px;
        display: inline-flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #e8f3ff;
        color: #2769a8;
        font-size: 23px;
    }

    .customer-brand-name {
        color: #243047;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: -0.3px;
        white-space: nowrap;
    }

    .customer-toggler {
        padding: 7px 9px;
        border: 1px solid #dce3ed;
        border-radius: 9px;
        box-shadow: none !important;
    }

    .customer-nav-links {
        align-items: center;
        gap: 12px;
        margin-left: 150px;
    }

    .customer-navbar .customer-nav-links .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: 11px 14px;
        border-radius: 9px;
        color: #5e6b80;
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        transition: color 0.2s ease, background 0.2s ease;
    }

    .customer-navbar .customer-nav-links .nav-link i {
        font-size: 15px;
    }

    .customer-navbar .customer-nav-links .nav-link:hover {
        color: #2769a8;
        background: #f4f8fd;
    }

    .customer-navbar .customer-nav-links .nav-link.active {
        color: #2769a8;
        background: #eaf3ff;
        font-weight: 600;
    }

    .customer-navbar .customer-nav-links .nav-link.active::after {
        position: absolute;
        right: 14px;
        bottom: 4px;
        left: 14px;
        height: 2px;
        border-radius: 2px;
        background: #2769a8;
        content: "";
    }

    /* Akun Customer */

    .customer-account {
        display: flex;
        align-items: center;
    }

    .customer-account-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 260px;
        padding: 7px 10px;
        border: 1px solid transparent;
        border-radius: 12px;
        background: transparent;
        color: #243047;
        text-align: left;
        transition: background 0.2s ease, border-color 0.2s ease;
    }

    .customer-account-toggle:hover,
    .customer-account-toggle.show {
        border-color: #e3eaf3;
        background: #f7f9fc;
    }

    .customer-account-toggle::after {
        margin-left: 5px;
        color: #7a8598;
    }

    .customer-account-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: #e8f3ff;
        color: #2769a8;
        font-size: 19px;
    }

    .customer-account-info {
        display: flex;
        flex-direction: column;
        min-width: 0;
        gap: 3px;
    }

    .customer-account-name {
        max-width: 170px;
        overflow: hidden;
        color: #243047;
        font-size: 11px;
        font-weight: 600;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .customer-account-role {
        color: #8791a2;
        font-size: 10px;
    }

    /* Dropdown akun */

    .customer-account-menu {
        width: 260px;
        margin-top: 10px !important;
        padding: 8px;
        border: 1px solid #e5eaf1;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 12px 35px rgba(36, 48, 71, 0.10);
    }

    .customer-dropdown-heading {
        padding: 12px 12px 10px;
    }

    .customer-dropdown-label {
        display: block;
        margin-bottom: 7px;
        color: #8791a2;
        font-size: 9px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .customer-dropdown-name {
        overflow-wrap: anywhere;
        color: #243047;
        font-size: 12px;
        font-weight: 600;
    }

    .customer-account-menu .dropdown-divider {
        border-color: #edf0f5;
        opacity: 1;
    }

    .customer-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 11px 12px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #526078;
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        text-align: left;
    }

    .customer-dropdown-item > i:first-child {
        width: 17px;
        color: #748198;
        font-size: 15px;
    }

    .customer-dropdown-item:hover {
        background: #f2f7fd;
        color: #2769a8;
    }

    .customer-dropdown-item:hover > i:first-child {
        color: #2769a8;
    }

    .customer-dropdown-item.active {
        background: #eaf3ff;
        color: #2769a8;
        font-weight: 600;
    }

    .customer-logout-trigger {
        color: #c03945;
    }

    .customer-logout-trigger > i:first-child {
        color: #c03945;
    }

    .customer-logout-trigger:hover {
        background: #fff1f1;
        color: #b02a37;
    }

    .customer-logout-trigger:hover > i:first-child {
        color: #b02a37;
    }

    /* Modal Logout Customer */

    .customer-logout-modal {
        overflow: hidden;
        border: 0;
        border-radius: 16px;
        box-shadow: 0 16px 48px rgba(36, 48, 71, 0.14);
    }

    .customer-logout-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        margin: 0 auto;
        border-radius: 14px;
        background: #fff0f0;
        color: #dc3545;
        font-size: 24px;
    }

    .customer-logout-title {
        color: #243047;
        font-size: 20px;
        font-weight: 600;
    }

    .customer-logout-description {
        color: #687386;
        font-size: 12px;
        line-height: 1.8;
    }

    .customer-logout-cancel,
    .customer-logout-confirm {
        min-width: 110px;
        padding: 10px 16px;
        border-radius: 9px;
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
    }

    .customer-logout-cancel {
        border: 1px solid #dce3ed;
        background: #f5f7fa;
        color: #526078;
    }

    .customer-logout-cancel:hover {
        border-color: #dce3ed;
        background: #e9edf3;
        color: #243047;
    }

    .customer-logout-confirm {
        border: 1px solid #dc3545;
        background: #dc3545;
        color: #fff;
    }

    .customer-logout-confirm:hover {
        border-color: #bb2d3b;
        background: #bb2d3b;
        color: #fff;
    }

    /* Responsive */

    @media (min-width: 992px) {
        .customer-navbar .navbar-collapse {
            min-width: 0;
        }
    }

    @media (max-width: 991.98px) {
        .customer-navbar .navbar-collapse {
            padding: 14px 0 8px;
        }

        .customer-nav-links {
            align-items: stretch;
            gap: 5px;
            margin: 8px 0 16px;
        }

        .customer-navbar .customer-nav-links .nav-link {
            display: flex;
            padding: 12px 14px;
        }

        .customer-navbar .customer-nav-links .nav-link.active::after {
            top: 9px;
            right: auto;
            bottom: 9px;
            left: 0;
            width: 3px;
            height: auto;
        }

        .customer-account {
            padding-top: 12px;
            border-top: 1px solid #edf0f5;
        }

        .customer-account-toggle {
            width: 100%;
            max-width: 100%;
        }

        .customer-account-name {
            max-width: min(65vw, 300px);
        }

        .customer-account-menu {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .customer-brand-name {
            font-size: 13px;
        }

        .customer-brand-icon {
            width: 38px;
            height: 38px;
            font-size: 21px;
        }
    }

        .customer-profile-page {
            max-width: 1100px;
            color: #243047;
        }

        .customer-profile-heading {
            margin: 0 0 8px;
            color: #243047;
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -0.6px;
        }

        .customer-profile-subtitle {
            margin: 0;
            color: #7a8598;
            font-size: 12px;
            line-height: 1.8;
        }

        .customer-profile-back {
            padding: 10px 14px;
            border: 1px solid #dce3ed;
            border-radius: 9px;
            background: #fff;
            color: #526078;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: background .2s ease, border-color .2s ease;
        }

        .customer-profile-back:hover {
            border-color: #2769a8;
            background: #f2f7fd;
            color: #2769a8;
        }

        /* Card */

        .customer-profile-card {
            padding: 25px;
            border: 1px solid #e5eaf1;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(36, 48, 71, .035);
        }

        /* Ringkasan profil */

        .customer-profile-overview {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .customer-profile-avatar {
            display: flex;
            flex: 0 0 64px;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: #e8f3ff;
            color: #2769a8;
            font-size: 28px;
        }

        .customer-profile-overview-info {
            min-width: 0;
        }

        .customer-profile-label {
            display: block;
            margin-bottom: 6px;
            color: #7a8598;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .customer-profile-overview-info h2 {
            margin: 0 0 7px;
            color: #243047;
            font-size: 19px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .customer-profile-overview-info p {
            margin: 0;
            color: #7a8598;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        /* Header informasi usaha */

        .customer-profile-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 22px;
            border-bottom: 1px solid #edf0f5;
        }

        .customer-profile-section-header h2 {
            margin: 0 0 6px;
            color: #243047;
            font-size: 16px;
            font-weight: 700;
        }

        .customer-profile-section-header p {
            margin: 0;
            color: #7a8598;
            font-size: 11px;
            line-height: 1.7;
        }

        .customer-profile-section-icon {
            display: flex;
            flex: 0 0 42px;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #f1f6fc;
            color: #2769a8;
            font-size: 19px;
        }

        /* Detail profil */

        .customer-profile-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0 30px;
        }

        .customer-profile-detail {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            min-width: 0;
            padding: 22px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .customer-profile-detail-full {
            grid-column: 1 / -1;
            border-bottom: 0;
        }

        .customer-profile-detail-icon {
            display: flex;
            flex: 0 0 36px;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f3f7fc;
            color: #55749a;
            font-size: 16px;
        }

        .customer-profile-detail-content {
            display: flex;
            flex: 1;
            flex-direction: column;
            gap: 6px;
            min-width: 0;
        }

        .customer-profile-detail-content span {
            color: #7a8598;
            font-size: 11px;
        }

        .customer-profile-detail-content strong {
            color: #344158;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .customer-profile-break {
            word-break: break-word;
        }

        /* Profil belum tersedia */

        .customer-profile-empty {
            padding: 30px 10px;
            text-align: center;
        }

        .customer-profile-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 16px;
            border-radius: 16px;
            background: #e8f3ff;
            color: #2769a8;
            font-size: 25px;
        }

        .customer-profile-empty h2 {
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: 700;
        }

        .customer-profile-empty p {
            max-width: 440px;
            margin: 0 auto;
            color: #7a8598;
            font-size: 12px;
            line-height: 1.8;
        }

        /* Responsive */

        @media (max-width: 575.98px) {
            .customer-profile-heading {
                font-size: 23px;
            }

            .customer-profile-card {
                padding: 19px;
                border-radius: 13px;
            }

            .customer-profile-overview {
                align-items: flex-start;
                gap: 13px;
            }

            .customer-profile-avatar {
                flex-basis: 48px;
                width: 48px;
                height: 48px;
                border-radius: 12px;
                font-size: 22px;
            }

            .customer-profile-overview-info h2 {
                font-size: 16px;
            }

            .customer-profile-details {
                grid-template-columns: minmax(0, 1fr);
            }

            .customer-profile-detail-full {
                grid-column: auto;
                border-bottom: 1px solid #edf0f5;
            }

            .customer-profile-detail:last-child {
                border-bottom: 0;
            }
        }

        .customer-profile-form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #edf0f5;
        }

        .customer-profile-form-actions .customer-profile-cancel,
        .customer-profile-form-actions .customer-profile-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 18px;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: none;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease,
                        color 0.2s ease;
        }

        /* Tombol Batal */
        .customer-profile-form-actions .customer-profile-cancel {
            color: #526078;
            background-color: #ffffff;
            border: 1px solid #dce3ed;
        }

        .customer-profile-form-actions .customer-profile-cancel:hover {
            color: #243047;
            background-color: #f1f5f9;
            border-color: #c5d0de;
        }

        /* Tombol Simpan Perubahan */
        .customer-profile-form-actions .customer-profile-save {
            color: #ffffff;
            background-color: #2769a8;
            border: 1px solid #2769a8;
        }

        .customer-profile-form-actions .customer-profile-save:hover {
            color: #ffffff;
            background-color: #1f568b;
            border-color: #1f568b;
        }

        /* Fokus keyboard */
        .customer-profile-form-actions .customer-profile-cancel:focus-visible,
        .customer-profile-form-actions .customer-profile-save:focus-visible {
            outline: 3px solid rgba(39, 105, 168, 0.2);
            outline-offset: 3px;
        }

        /* Tampilan mobile */
        @media (max-width: 575.98px) {
            .customer-profile-form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .customer-profile-form-actions .btn {
                width: 100%;
            }
        }

        .customer-flash {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 16px 46px 16px 16px;
            margin-bottom: 22px;
            border: 1px solid transparent;
            border-left: 4px solid;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            animation: customer-flash-appear 0.25s ease-out;
        }

        .customer-flash-icon {
            display: flex;
            flex: 0 0 38px;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            font-size: 17px;
        }

        .customer-flash-content {
            flex: 1;
            min-width: 0;
        }

        .customer-flash-content strong {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 600;
        }

        .customer-flash-content p,
        .customer-flash-content ul {
            margin-bottom: 0;
            font-size: 12px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .customer-flash-close {
            position: absolute;
            top: 17px;
            right: 16px;
        }

        /* Tambah: hijau */
        .customer-flash-create {
            color: #17663a;
            background: #eff9f2;
            border-color: #ccebd5;
            border-left-color: #198754;
        }

        .customer-flash-create .customer-flash-icon {
            background: #d9f1e1;
            color: #198754;
        }

        /* Edit: biru */
        .customer-flash-edit {
            color: #174b91;
            background: #eff6ff;
            border-color: #d2e5ff;
            border-left-color: #2769a8;
        }

        .customer-flash-edit .customer-flash-icon {
            background: #dcecff;
            color: #2769a8;
        }

        /* Hapus dan error: merah */
        .customer-flash-delete,
        .customer-flash-error {
            color: #a52834;
            background: #fff1f1;
            border-color: #f5d0d3;
            border-left-color: #dc3545;
        }

        .customer-flash-delete .customer-flash-icon,
        .customer-flash-error .customer-flash-icon {
            background: #ffdddd;
            color: #dc3545;
        }

        /* Warning: kuning */
        .customer-flash-warning {
            color: #805b08;
            background: #fff9e8;
            border-color: #f3e3ae;
            border-left-color: #d99a00;
        }

        .customer-flash-warning .customer-flash-icon {
            background: #fff0bd;
            color: #b58100;
        }

        /* Info: biru muda */
        .customer-flash-info {
            color: #24556f;
            background: #eff9ff;
            border-color: #d0eaf7;
            border-left-color: #0d9ac4;
        }

        .customer-flash-info .customer-flash-icon {
            background: #d9f2ff;
            color: #0d83aa;
        }

        @keyframes customer-flash-appear {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 575.98px) {
            .customer-flash {
                gap: 10px;
                padding: 13px 38px 13px 12px;
                margin-bottom: 18px;
            }

            .customer-flash-icon {
                flex-basis: 32px;
                width: 32px;
                height: 32px;
                font-size: 15px;
            }

            .customer-flash-content strong {
                font-size: 12px;
            }

            .customer-flash-content p,
            .customer-flash-content ul {
                font-size: 11px;
            }

            .customer-flash-close {
                top: 13px;
                right: 10px;
            }
        }

        
        .payment-back-link {
            color: #2769a8;
            transition: color 0.2s ease;
        }

        .payment-back-link:hover {
            color: #1f568b;
        }

        .payment-card {
            background: #ffffff;
            border: 1px solid #e3eaf2;
            border-radius: 1rem;
            box-shadow: 0 4px 18px rgba(36, 48, 71, 0.04);
        }

        .payment-method-info {
            background: linear-gradient(135deg, #f2f8ff 0%, #ffffff 100%);
            border: 1px solid #dce9f8;
            border-radius: 0.875rem;
        }

        .payment-total-card {
            background: linear-gradient(135deg, #eef6ff 0%, #f8fbff 100%);
            border: 1px solid #dce9f8;
            border-radius: 0.875rem;
        }

        .payment-primary-button {
            color: #ffffff;
            background: #2769a8;
            border: 1px solid #2769a8;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease,
                        box-shadow 0.2s ease,
                        transform 0.2s ease;
        }

        .payment-primary-button:hover {
            color: #ffffff;
            background: #1f568b;
            border-color: #1f568b;
            box-shadow: 0 5px 14px rgba(39, 105, 168, 0.18);
            transform: translateY(-1px);
        }

        .payment-primary-button:focus-visible {
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(39, 105, 168, 0.2);
        }

        .payment-primary-button:active {
            color: #ffffff !important;
            background: #194774 !important;
            border-color: #194774 !important;
            transform: translateY(0);
        }

        .payment-primary-button:disabled {
            color: #ffffff;
            background: #7da3c9;
            border-color: #7da3c9;
            box-shadow: none;
            transform: none;
            cursor: wait;
        }

        .payment-step-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e8f3ff;
            border-radius: 0.75rem;
            color: #2769a8;
        }

        .customer-orders-page {
            color: #243047;
        }

        .customer-orders-hero {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border: 1px solid #dce9f8;
            border-radius: 20px;
            background: linear-gradient(120deg, #eaf4ff 0%, #ffffff 75%);
        }

        .customer-orders-eyebrow {
            color: #2769a8;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .customer-orders-hero-icon {
            width: 76px;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #dce9f8;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            color: #2769a8;
            font-size: 34px;
        }

        .customer-orders-primary-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid #2769a8;
            border-radius: 10px;
            background: #2769a8;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease,
                        box-shadow 0.2s ease,
                        transform 0.2s ease;
        }

        .customer-orders-primary-link:hover {
            background: #1f568b;
            border-color: #1f568b;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(39, 105, 168, 0.18);
            transform: translateY(-1px);
        }

        .customer-orders-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin: 28px 0 16px;
        }

        .customer-orders-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border: 1px solid #dce9f8;
            border-radius: 999px;
            background: #e8f3ff;
            color: #2769a8;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .customer-order-list {
            display: grid;
            gap: 16px;
        }

        .customer-order-card {
            overflow: hidden;
            border: 1px solid #e3eaf2;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 3px 12px rgba(36, 48, 71, 0.035);
            transition: border-color 0.2s ease,
                        box-shadow 0.2s ease,
                        transform 0.2s ease;
        }

        .customer-order-card:hover {
            border-color: #cbdff4;
            box-shadow: 0 8px 22px rgba(36, 48, 71, 0.07);
            transform: translateY(-2px);
        }

        .customer-order-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 22px;
        }

        .customer-order-identity {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            min-width: 0;
        }

        .customer-order-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #dce9f8;
            border-radius: 12px;
            background: #e8f3ff;
            color: #2769a8;
            font-size: 21px;
        }

        .customer-order-overline {
            display: block;
            margin-bottom: 4px;
            color: #687386;
            font-size: 12px;
        }

        .customer-order-number {
            margin: 0;
            color: #243047;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .customer-order-date {
            margin-top: 5px;
            color: #687386;
            font-size: 12px;
        }

        .customer-order-divider {
            height: 1px;
            margin: 0 22px;
            background: #edf1f6;
        }

        .customer-order-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-shrink: 0;
            padding: 7px 11px;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
            text-align: center;
        }

        .order-status-pending {
            color: #946200;
            background: #fff7df;
            border-color: #f5e4aa;
        }

        .order-status-confirmed {
            color: #2769a8;
            background: #e8f3ff;
            border-color: #d4e5fa;
        }

        .order-status-processing {
            color: #16719b;
            background: #e8f6ff;
            border-color: #cceafa;
        }

        .order-status-complete {
            color: #23834d;
            background: #f0fdf4;
            border-color: #d2ecd9;
        }

        .order-status-cancelled {
            color: #b42318;
            background: #fff1f1;
            border-color: #f5d0ce;
        }

        .order-status-default {
            color: #596273;
            background: #f3f4f6;
            border-color: #e1e5eb;
        }

        .customer-order-card-body {
            padding: 20px 22px;
        }

        .customer-order-info-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 20px;
        }

        .customer-order-info-label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            color: #687386;
            font-size: 12px;
        }

        .customer-order-info-label i {
            color: #2769a8;
            font-size: 15px;
        }

        .customer-order-merchant {
            color: #243047;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .customer-order-info-value {
            color: #243047;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.7;
        }

        .customer-order-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            padding: 16px 22px;
            border-top: 1px solid #edf1f6;
            background: #fcfdff;
        }

        .customer-order-payment {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 7px;
        }

        .customer-order-payment-label {
            color: #687386;
            font-size: 12px;
        }

        .customer-payment-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.4;
        }

        .order-payment-pending {
            color: #946200;
            background: #fff7df;
            border-color: #f5e4aa;
        }

        .order-payment-success {
            color: #23834d;
            background: #f0fdf4;
            border-color: #d2ecd9;
        }

        .order-payment-failed {
            color: #b42318;
            background: #fff1f1;
            border-color: #f5d0ce;
        }

        .order-payment-expired {
            color: #596273;
            background: #f3f4f6;
            border-color: #e1e5eb;
        }

        .order-payment-default {
            color: #596273;
            background: #f3f4f6;
            border-color: #e1e5eb;
        }

        .customer-order-total {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
            min-width: 0;
        }

        .customer-order-total-label {
            color: #687386;
            font-size: 12px;
        }

        .customer-order-total-value {
            color: #2769a8;
            font-size: 19px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .customer-order-detail-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 14px;
            border: 1px solid #cbddef;
            border-radius: 9px;
            background: #ffffff;
            color: #2769a8;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: background-color 0.2s ease,
                        color 0.2s ease,
                        border-color 0.2s ease,
                        box-shadow 0.2s ease;
        }

        .customer-order-detail-link:hover {
            border-color: #2769a8;
            background: #2769a8;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(39, 105, 168, 0.14);
        }

        .customer-orders-empty {
            padding: 48px 24px;
            border: 1px solid #e3eaf2;
            border-radius: 18px;
            background: #ffffff;
            text-align: center;
        }

        .customer-orders-empty-icon {
            width: 76px;
            height: 76px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            border: 1px solid #dce9f8;
            border-radius: 50%;
            background: #e8f3ff;
            color: #2769a8;
            font-size: 34px;
        }

        .customer-orders-pagination {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .customer-orders-pagination .pagination {
            flex-wrap: wrap;
            gap: 5px;
        }

        .customer-orders-pagination .page-link {
            border-radius: 8px;
            border-color: #e3eaf2;
            color: #2769a8;
        }

        .customer-orders-pagination .page-item.active .page-link {
            border-color: #2769a8;
            background: #2769a8;
            color: #ffffff;
        }

        .customer-orders-pagination .page-item.disabled .page-link {
            color: #a0a9b7;
        }

        @media (max-width: 575.98px) {
            .customer-orders-hero {
                padding: 22px 18px;
                border-radius: 16px;
            }

            .customer-orders-hero-icon {
                width: 54px;
                height: 54px;
                font-size: 25px;
            }

            .customer-order-card-header {
                flex-direction: column;
                padding: 18px;
            }

            .customer-order-divider {
                margin: 0 18px;
            }

            .customer-order-card-body {
                padding: 18px;
            }

            .customer-order-info-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 16px;
            }

            .customer-order-card-footer {
                align-items: stretch;
                padding: 18px;
            }

            .customer-order-total {
                align-items: flex-start;
            }

            .customer-order-detail-link {
                width: 100%;
            }

            .customer-orders-empty {
                padding: 36px 18px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .customer-order-card,
            .customer-orders-primary-link,
            .customer-order-detail-link {
                transition: none;
            }

            .customer-order-card:hover,
            .customer-orders-primary-link:hover {
                transform: none;
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

        .customer-order-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .customer-order-menu-photo {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            object-fit: cover;
            border: 1px solid #e3eaf2;
            border-radius: 10px;
            background: #f1f7ff;
        }

        .customer-order-menu-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8bb5df;
            font-size: 23px;
        }

        .customer-order-menu-details {
            flex: 1;
            min-width: 0;
        }

        .customer-order-menu-name {
            margin-bottom: 4px;
            color: #243047;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .customer-order-menu-meta {
            color: #687386;
            font-size: 12px;
        }

        .customer-order-menu-more {
            color: #2769a8;
            font-size: 12px;
            font-weight: 500;
        }

        .customer-order-detail-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        .customer-order-detail-menu .customer-order-menu-photo {
            width: 54px;
            height: 54px;
            flex-basis: 54px;
            border-radius: 9px;
        }

        @media (max-width: 575.98px) {
            .customer-order-menu-photo {
                width: 50px;
                height: 50px;
                flex-basis: 50px;
            }

            .customer-order-detail-menu {
                min-width: 160px;
                gap: 8px;
            }

            .customer-order-detail-menu .customer-order-menu-photo {
                width: 44px;
                height: 44px;
                flex-basis: 44px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('customer.layouts.header')

    <main class="customer-content">
        @include('customer.partials.flash-alert')

        @yield('content')
    </main>


    @include('customer.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
