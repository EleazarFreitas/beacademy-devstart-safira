@extends('layouts.template')
@section('title','Pedidos')

@section('content')

    <h1 class="text-primary mt-4">Listagem de Pedidos</h1>

    <table class="table table-striped mt-4">
        <thead class="text-center">
            <tr>
               <th scope="col">ID</th> 
               <th scope="col">Usuário</th> 
               <th scope="col">Produto</th> 
               <th scope="col">Valor</th> 
               <th scope="col">Status</th> 
               <th scope="col">Data do Pedido</th> 
            </tr>
        </thead>
        <tbody class="text-center">
        @foreach($orders as $order)
            <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->product->name}}</td>
            <td>{{ $order->product->sale_price }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
            <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-info text-white">Visualizar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection