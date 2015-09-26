@extends('app')

@section('content')

    <div class="container">

        <h3>Pedidos</h3>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm pull-right">Voltar</a><br><br>

        <h4>Pedido</h4>
        <table class="table table-bordered">
            <thead>
                <th width="5%">Id</th>
                <th>Cliente</th>
                <th width="15%">Total</th>
                <th width="15%">Status</th>
            </thead>
            <tboty>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            </tboty>
        </table>

        <br>

        <h4>Items</h4>
        <table class="table table-bordered">
            <thead>
                <th width="5%">Id</th>
                <th>Item</th>
                <th width="15%">Preço</th>
                <th width="15%">Qtd</th>
            </thead>
            <tboty>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->qtd }}</td>
                    </tr>
                @endforeach
            </tboty>
        </table>

    </div>{{--/container--}}

@endsection