<header class="bg-white border-bottom px-4 py-3"
        style="border-color: var(--border) !important;">
    <div class="d-flex align-items-center justify-content-between gap-3">
        <div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 40px; height: 40px; background: var(--primary-light); color: var(--primary);">
                <i class="bi bi-person fs-5"></i>
            </span>

            <div>
                <div class="fw-semibold small">
                    {{ auth()->user()->nama ?? auth()->user()->email }}
                </div>
                <div class="small" style="color: var(--muted);">
                    Merchant
                </div>
            </div>
        </div>
    </div>
</header>
