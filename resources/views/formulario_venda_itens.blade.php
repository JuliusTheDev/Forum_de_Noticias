@extends('template.app')

@section('conteudo')
<h1>Formulário Venda</h1>
    <div class="row">
        <div class="col mb-3">
            <label for="id" class="form-label">ID</label>
            <input readonly type="text" class="form-control" id="id" name="id" value="{{$venda->id}}">
        </div>
        <div class="col mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input  readonly type="text" class="form-control" id="documento" name="documento"  value="{{$venda->documento}}">
        </div>
        <div class="col mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <input  readonly type="text" class="form-control" id="forma_pagamento" name="forma_pagamento"  value="{{$venda->forma_pagamento}}">
        </div>

    </div>
    <div class="row">
        <div class="col mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input  redonly type="text" class="form-control" id="valor" name="valor"  value="{{$venda->valor}}">
        </div>
        <div class="col mb-3">
            <label for="data" class="form-label">Data</label>
            <input  readonly type="date" class="form-control" id="data" name="data"  value="{{$venda->data->format('Y-m-d')}}">
        </div>
        <div class="col mb-3">
            <label for="cliente_nome" class="form-label">Cliente</label>
            <input  redonly type="text" class="form-control" id="cliente_nome" name="cliente_nome"  value="{{$venda->cliente->nome}}">
        </div>
    </div>
    <form action="/venda/salvarItens" method="POST">
    @csrf

    <input type="hidden" name="venda_id" value={{$venda->id}}>
    <div class="row border border-primary p-3">
            <div class="col mb-3">
                <label for="produto_id" class="form-label">Produto</label>
                <select class="form-select" id="produto_id" name="produto_id">
                    @foreach ($produtos as $produto)
                        <option  value="{{$produto->id}}">{{$produto->descricao}} (R$ {{$produto->valor}} ) </option>
                    @endforeach
                </select>            
            </div>
            <div class="col mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input  type="number" class="form-control" id="quantidade" name="quantidade"  value="1">
            </div>
            <div class="col">
                <button class= "btn btn-primary" type="submit">Adicionar</button>
            </div>
    </div>
    
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
            <th scope="col">Remover</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($venda->item_vendas as $item)
            <tr>
            <td>{{$item->produto->descricao}}</td>
            <td>{{$item->quantidade}}</td>
            <td>{{$item->valor_unitario}}</td>
            <td>{{$item->valor_total}}</td>
            <td>
                <form action="/venda/deleteItem" method="POST" >
                    @csrf
                    <input type="hidden" name="id" value={{$item->id}}>
                    <input type="hidden" name="venda_id" value={{$venda->id}}>
                    <button type="submit" class="btn btn-danger">-</button>
                </form>
            </td>

            </tr>
            @endforeach
        </tbody>
        </table>    


    </div>
    <a class="mt-3 btn btn-primary" href="/venda/listar">Retornar</a>

@endsection