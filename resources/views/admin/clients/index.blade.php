@extends('app')

@section('content')

    <div class="container">

        <h3>Clientes</h3>

        <a href="{{ route('admin.clients.create') }}" class="btn btn-default btn-sm pull-right">Novo Cliente</a><br><br>

        <table class="table table-bordered">
            <thead>
                <th width="5%">Id</th>
                <th>Cliente</th>
                <th width="10%">Ação</th>
            </thead>
            <tboty>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.clients.destroy', ['id' => $client->id]) }}" class="btn btn-danger btn-xs">Excluir</a>
                            <a href="{{ route('admin.clients.edit', ['id' => $client->id]) }}" class="btn btn-primary btn-xs">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tboty>
        </table>

        {!! $clients->render() !!}


    </div>{{--/container--}}

@endsection