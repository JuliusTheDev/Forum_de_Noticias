@extends('template.app')

@section('conteudo')

<h1>Formulário Venda</h1>
    <form action="/venda/salvar2" method="POST">
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


        <div class="row border border-primary p-3">
            <div class="col mb-3">
                <label for="prod" class="form-label">Produto</label>
                <select class="form-select" id="prod" name="prod">
                    @foreach ($produtos as $produto)
                        <option  value="{{$produto->id}}">{{$produto->descricao}} (R$ {{$produto->valor}} ) </option>
                    @endforeach
                </select>            
            </div>
            <div class="col mb-3">
                <label for="quant" class="form-label">Quantidade</label>
                <input  type="number" class="form-control" id="quant" name="quant"  value="1">
            </div>
            <div class="col">
                <button class= "btn btn-primary" type="button" id="btnAdicionar">Adicionar</button>
            </div>
    </div>
        

    <div class="container">
    <h1>Itens</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Vr.Unit.</th>
            <th scope="col">vr.Total</th>
            <th scope="col">Remover</th>
            </tr>
        </thead>
        <tbody id="corpo">
            @foreach ($venda->item_vendas as $item)
            <tr>
            <td><input readonly type="text" name='produto_id[]' value='{{$item->produto->id}}'></td>
            <td>{{$item->produto->descricao}}</td>
            <td><input readonly type="text" name='quantidade[]' value='{{$item->quantidade}}'></td>
            <td>{{$item->valor_unitario}}</td>
            <td>{{$item->valor_total}}</td>
            <td><button type="button" class="btn btn-danger btn-remover" type="button">-</button></td>
            </tr>
            @endforeach
        </tbody>
        </table>    


    </div>



        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>    


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
      var produtos = {!! $produtos !!};
      var $quant = $('#quant');
      var $prod = $('#prod');
      var $corpo = $('#corpo');
      var $valor = $('#valor');
      var valor = {!! $venda->valor !!};
      var $btnRemover = $('.btn-remover');
      $btnRemover.click(removeLinha);


      var $btnAdicionar = $('#btnAdicionar');
      $btnAdicionar.click(function() {
        var produto = buscarProduto($prod.val());
        var quant = $quant.val();
        var linha = geraLinha(produto, quant);
        $corpo.append(linha);
        valor += produto['valor'] * quant;
        $valor.val(valor);
        var $btnRemover = $('.btn-remover');
        $btnRemover.unbind('click');
        $btnRemover.click(removeLinha);

      });

      function removeLinha() {
        $elemento = $(event.target);
        $linha = $elemento.parents("tr");
        var codigo = $linha.find(':nth-child(1)').find('input').val();
        var produto = buscarProduto(codigo);
        console.log(produto);
        var qtde = $linha.find(':nth-child(3)').find('input').val();
        var valorUnitario = parseFloat(produto.valor);
        var valorTotal = qtde * valorUnitario;
        console.log(valorTotal);
        console.log(valor);
        valor -=  valorTotal;
        mostraValorTotal();
        $linha.remove();   
        event.preventDefault();     
      } 
      
      function mostraValorTotal() {
        $valor.val(valor);
      }

      function buscarProduto(id) {
        for(i=0;i<produtos.length;i++) {
            if (produtos[i]['id'] == id) {
                return produtos[i];
            }
        }
      }

      function geraLinha(produto, quant) {
        var valorTotal = produto['valor'] * quant;
        return `<tr>
            <td><input readonly type="text" name="produto_id[]" value="${produto['id']}"> </td>
            <td>${produto['descricao']}</td>
            <td><input readonly type="text" name="quantidade[]" value="${quant}"></td>
            <td>${produto['valor']}</td>
            <td>${valorTotal}</td>
            <td><button type="button" class="btn btn-danger btn-remover" type="button">-</button></td>
            </tr>`;
      }
      

    </script>

@endsection

