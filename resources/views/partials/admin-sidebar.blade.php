<aside class="as-admin-sidebar">
    <div class="px-3 mb-3">
        <span class="badge bg-warning text-dark">Админ</span>
    </div>
    <div class="sidebar-title">Управление</div>
    <nav class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i>Обзор
        </a>
        <a class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}" href="{{ route('admin.appointments.index') }}">
            <i class="bi bi-calendar-check me-2"></i>Записи
        </a>
        <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
            <i class="bi bi-wrench me-2"></i>Услуги
        </a>
    </nav>
    <div class="px-3 mt-4">
        <a href="{{ url('/') }}" class="nav-link px-0"><i class="bi bi-house me-2"></i>На сайт</a>
    </div>
</aside>
