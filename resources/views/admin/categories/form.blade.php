@extends('app')

@section('content')

    <div class="container">

        <h3>{{ empty($category) ? 'Adicionar Categoria' : 'Atualizar Categoria' }}</h3>

        @include('errors._check')

        @if(!empty($category))
            {!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.categories.store', 'class' => 'form-horizontal']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Nome:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('admin.categories.index') }}" role="button">Cancelar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection