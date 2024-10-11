@extends('template.app')

@section('conteudo')
<h1>Listagem de Vendas</h1>
    <a class="btn btn-primary" href="/venda/novo">Nova Venda</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Data</th>
            <th scope="col">Documento</th>
            <th scope="col">Valor</th>
            <th scope="col">Forma Pagamento</th>
            <th scope="col">Editar Dados</th>
            <th scope="col">Editar Itens</th>
            <th scope="col">Remover</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
            <tr>
            <th scope="row">{{$venda->id}}</th>
            <td>{{$venda->cliente->nome}}</td>
            <td>{{$venda->data->format('d/m/Y')}}</td>
            <td>{{$venda->documento}}</td>
            <td>{{$venda->valor}}</td>
            <td>{{$venda->forma_pagamento}}</td>
            <td><a class="btn btn-primary" href="/venda/editar/{{$venda->id}}">+ Dados</a></td>
            <td><a class="btn btn-primary" href="/venda/editarItens/{{$venda->id}}">+ Itens</a></td>
            <td><a class="btn btn-danger" href="/venda/excluir/{{$venda->id}}">-</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>    

@endsection