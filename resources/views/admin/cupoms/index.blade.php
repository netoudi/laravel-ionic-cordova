@extends('app')

@section('content')

    <div class="container">

        <h3>Cupoms</h3>

        <a href="{{ route('admin.cupoms.create') }}" class="btn btn-default btn-sm pull-right">Novo Cupom</a><br><br>

        <table class="table table-bordered">
            <thead>
                <th width="5%">Id</th>
                <th>Código</th>
                <th>Valor</th>
                <th width="10%">Ação</th>
            </thead>
            <tboty>
                @foreach($cupoms as $cupom)
                    <tr>
                        <td>{{ $cupom->id }}</td>
                        <td>{{ $cupom->code }}</td>
                        <td>{{ $cupom->value }}</td>
                        <td>
                            <a href="{{ route('admin.cupoms.destroy', ['id' => $cupom->id]) }}" class="btn btn-danger btn-xs">Excluir</a>
                            <a href="{{ route('admin.cupoms.edit', ['id' => $cupom->id]) }}" class="btn btn-primary btn-xs">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>

        {!! $cupoms->render() !!}

    </div>{{--/container--}}

@endsection