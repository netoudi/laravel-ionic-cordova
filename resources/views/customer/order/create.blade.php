@extends('app')

@section('content')

    <div class="container">

        <h3>Novo Pedido</h3>

        @include('errors._check')

        {!! Form::open(['route' => 'customer.order.store', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            <div class="col-sm-12">
                <label>Total:</label>

                <p id="total"></p>
                <a href="#" id="btnNewItem" class="btn btn-default pull-right">Novo Item</a>
                <br>
                <br>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    </tr>
                    <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="items[0][product_id]">
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}">
                                        {{ $p->name }} --- {{ $p->price }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::text('items[0][qtd]', 1, ['class' => 'form-control']) !!}
                        </td>
                    </tr>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                {!! Form::submit('Salvar', ['class' => 'btn bg-primary btn-sm']) !!}
                <a class="btn btn-warning btn-sm" href="{{ route('customer.order.index') }}"
                   role="button">Cancelar
                </a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>{{--/container--}}

@endsection

@section('post-script')
    <script>
        $(document).ready(function () {

            calculateTotal();

            $('#btnNewItem').click(function () {
                var row = $('table tbody > tr:last'),
                        newRow = row.clone(),
                        length = $('table tbody tr').length;

                newRow.find('td').each(function () {
                    var td = $(this),
                            input = td.find('input,select'),
                            name = input.attr('name');

                    input.attr('name', name.replace((length - 1) + "", length + ""));

                });

                newRow.find('input').val(1);
                newRow.insertAfter(row);
                calculateTotal();
            });

            $(document.body).on('change', 'select', function () {
                calculateTotal();
            });

            $(document.body).on('blur', 'input', function () {
                calculateTotal();
            });

        });

        function calculateTotal() {
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, price, qtd;

            for (var i = 0; i < trLen; i++) {
                tr = $('table tbody tr').eq(i);
                price = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }

            $('#total').html(total);
        }
    </script>
@endsection
