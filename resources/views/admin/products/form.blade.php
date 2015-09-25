@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($product) ? 'Adicionar Produto' : 'Atualizar Produto' }}</h3>

        @include('errors._check')

        @if(!empty($product))
            {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Nome:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Categoria:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Descrição:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('price', 'Preço:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.products.index') }}" role="button">Cancelar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection