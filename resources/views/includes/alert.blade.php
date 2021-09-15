@if ($message = Session::get('toast_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="mdi mdi-check-all me-2"></i>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('toast_error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="mdi mdi-block-helper me-2"></i>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('toast_warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="mdi mdi-alert-outline me-2"></i>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('toast_info'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="mdi mdi-alert-circle-outline me-2"></i>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('toast_question'))
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ $message }}
    </div>
@endif
