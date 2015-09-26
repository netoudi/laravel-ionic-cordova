@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($order) ? 'Adicionar Pedido' : 'Atualizar Pedido' }}</h3>

        @include('errors._check')

        @if(!empty($order))
            {!! Form::model($order, ['route' => ['admin.orders.update', $order->id], 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.orders.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('id', 'Id:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <input type="text" value="{{ $order->id }}" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('client[name]', 'Cliente:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <input type="text" value="{{ $order->client->name }}" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('total', 'Total:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <input type="text" value="{{ $order->total }}" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('status', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('user_deliveryman_id', 'Entregador:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.orders.index') }}" role="button">Cancelar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection