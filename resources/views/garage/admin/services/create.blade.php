@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новая услуга</h1>
    @include('garage.admin.services._form', ['route' => route('admin.services.store'), 'method' => 'POST', 'service' => null])
</div>
@endsection
