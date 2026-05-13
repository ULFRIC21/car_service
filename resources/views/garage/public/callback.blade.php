@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-3">Заказать обратный звонок</h1>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form method="post" action="{{ route('callback.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Телефон</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Комментарий</label>
                    <textarea name="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</div>
@endsection
