@extends('app')

@section('content')
    <div class="container">
        <h3>Categorias</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-default btn-sm pull-right">Nova Categoria</a><br><br>
        <table class="table table-bordered">
            <thead>
            <th width="5%">Id</th>
            <th>Nome</th>
            <th width="10%">Ação</th>
            </thead>
            <tboty>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-xs">Excluir</a>
                            <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-xs">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>
        {!! $categories->render() !!}
    </div>{{--/container--}}
@endsection