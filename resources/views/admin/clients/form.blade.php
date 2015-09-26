@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($client) ? 'Adicionar Cliente' : 'Atualizar Cliente' }}</h3>

        @include('errors._check')

        @if(!empty($client))
            {!! Form::model($client, ['route' => ['admin.clients.update', $client->id], 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.clients.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('user[name]', 'Nome:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('user[email]', 'E-mail:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('phone', 'Telefone:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Endereço:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('city', 'Cidade:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('city', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('state', 'Estado:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('state', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('zipcode', 'CEP:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.clients.index') }}" role="button">Cancelar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection