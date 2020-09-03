@extends('layouts.front')

@section('content')

    <h2 class="alert alert-success">Seu pedido foi processado. Código do pedido: {{ request()->get('order'))}}</h2>
@endsection