@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Личный кабинет</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p>Привет, {{ Auth::user()->full_name }}.</p>
            @if (Auth::user()->phone)
                <p>Телефон: {{ Auth::user()->phone }}</p>
            @endif

            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-dark btn-sm">Админка</a>
            @endif

            <a href="{{ route('appointments.index') }}" class="btn btn-primary btn-sm">Мои записи</a>
            <a href="{{ route('appointments.create') }}" class="btn btn-outline-primary btn-sm">+ Запись</a>
        </div>
    </div>
</div>
@endsection
