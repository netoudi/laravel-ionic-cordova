@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($cupom) ? 'Adicionar Cupom' : 'Atualizar Cupom' }}</h3>

        @include('errors._check')

        @if(!empty($cupom))
            {!! Form::model($cupom, ['route' => ['admin.cupoms.update', $cupom->id], 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.cupoms.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('code', 'Código:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('value', 'Valor:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('value', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.cupoms.index') }}" role="button">Cancelar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection