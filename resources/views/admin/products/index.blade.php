@extends('app')

@section('content')

    <div class="container">

        <h3>Produtos</h3>

        <a href="{{ route('admin.products.create') }}" class="btn btn-default btn-sm pull-right">Novo Produto</a><br><br>

        <table class="table table-bordered">
            <thead>
                <th width="5%">Id</th>
                <th>Produto</th>
                <th width="25%">Categoria</th>
                <th width="15%">Preço</th>
                <th width="10%">Ação</th>
            </thead>
            <tboty>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-danger btn-xs">Excluir</a>
                            <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-primary btn-xs">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>

        {!! $products->render() !!}

    </div>{{--/container--}}

@endsection