@extends('layouts.app')

@section('title', 'Обратный звонок — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container">
        <h1>Заказать обратный звонок</h1>
        <p class="text-muted mb-0">Перезвоним в течение 15 минут в рабочее время</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="as-card p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="post" action="{{ route('callback.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Ваше имя</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" required placeholder="Иван">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Телефон</label>
                        <input type="tel" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}" required placeholder="+7 (999) 000-00-00">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Что вас интересует?</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Например: замена масла, диагностика...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn as-btn-cta btn-lg w-100">
                        <i class="bi bi-telephone-outbound me-2"></i>Жду звонка
                    </button>
                </form>
                <p class="text-muted small text-center mt-3 mb-0">Или позвоните: <a href="tel:+74951234567">+7 (495) 123-45-67</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
