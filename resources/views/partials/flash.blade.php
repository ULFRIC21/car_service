@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show container mt-3 mb-0" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
    </div>
@endif
