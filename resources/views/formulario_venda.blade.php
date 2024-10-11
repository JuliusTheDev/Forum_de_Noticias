@extends('template.app')

@section('conteudo')
<h1>Formulário Venda</h1>
    <form action="/venda/salvar" method="POST">
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label for="id" class="form-label">ID</label>
                <input readonly type="text" class="form-control" id="id" name="id" value="{{$venda->id}}">
            </div>
            <div class="col mb-3">
                <label for="documento" class="form-label">Documento</label>
                <input  type="text" class="form-control" id="documento" name="documento"  value="{{$venda->documento}}">
            </div>
            <div class="col mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                <input  type="text" class="form-control" id="forma_pagamento" name="forma_pagamento"  value="{{$venda->forma_pagamento}}">
            </div>

        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input  type="text" class="form-control" id="valor" name="valor"  value="{{$venda->valor}}">
            </div>
            <div class="col mb-3">
                <label for="data" class="form-label">Data</label>
                <input  type="date" class="form-control" id="data" name="data"  value="{{$venda->data->format('Y-m-d')}}">
            </div>
            <div class="col mb-3">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select class="form-select" id="cliente_id" name="cliente_id">
                    @foreach ($clientes as $cliente)
                        <option  
                            @if ($cliente->id == $venda->cliente_id)
                                selected
                            @endif
                        value="{{$cliente->id}}">{{$cliente->nome}}</option>
                    @endforeach
                </select>            
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>    

    <div class="container">
    <h1>Itens</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Vr.Unit.</th>
            <th scope="col">vr.Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venda->item_vendas as $item)
            <tr>
            <td>{{$item->produto->descricao}}</td>
            <td>{{$item->quantidade}}</td>
            <td>{{$item->valor_unitario}}</td>
            <td>{{$item->valor_total}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>    


    </div>

@endsection


