<div class="col-lg-4">
    <div class="stats-card {{ $type }} d-flex justify-content-between align-items-center">
        <div>
            <h2 id="{{ $id }}">{{ $value }}</h2>
            <p><i class="{{ $chartIcon }} me-1"></i> {{ $label }} <span class="year-label">{{ $year }}</span></p>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
</div>