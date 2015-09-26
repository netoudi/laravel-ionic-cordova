@extends('app')

@section('content')

    <div class="container">

        <h3>Pedidos</h3>

        <table class="table table-bordered mrgT50">
            <thead>
                <th width="5%">Id</th>
                <th>Cliente</th>
                <th width="15%">Total</th>
                <th width="15%">Status</th>
                <th width="15%">Ação</th>
            </thead>
            <tboty>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->client->name }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.destroy', ['id' => $order->id]) }}" class="btn btn-danger btn-xs">Excluir</a>
                            <a href="{{ route('admin.orders.view', ['id' => $order->id]) }}" class="btn btn-primary btn-xs">Items</a>
                            <a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" class="btn btn-primary btn-xs">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>

        {!! $orders->render() !!}

    </div>{{--/container--}}

@endsection