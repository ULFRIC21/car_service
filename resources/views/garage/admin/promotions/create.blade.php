@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новая акция</h1>
    @include('garage.admin.promotions._form', ['route' => route('admin.promotions.store'), 'method' => 'POST', 'promotion' => null])
</div>
@endsection
