@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новая запчасть</h1>
    @include('garage.admin.parts._form', ['route' => route('admin.parts.store'), 'method' => 'POST', 'part' => null])
</div>
@endsection
