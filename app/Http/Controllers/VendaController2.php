<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Item_venda;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Venda;

class VendaController2 extends Controller
{
    function listar2() {
        $vendas = Venda::all();
        return view("listagem_venda2", compact('vendas') );
    }

    function editar2($id) {
        $produtos = Produto::orderBy('descricao')->get();
        $venda = Venda::find($id);
        $clientes = Cliente::orderBy('nome')->get();
        return view('formulario_venda2', compact('venda', 'clientes', 'produtos'));
    }


    function novo2() {
        $venda = new Venda();
        $venda->data = now();
        $venda->id = 0;
        $venda->valor = 0;
        $clientes = Cliente::orderBy('nome')->get();
        $produtos = Produto::orderBy('descricao')->get();
        return view('formulario_venda2', compact('venda', 'clientes', 'produtos'));
    }

    function salvar2(Request $request) {
        if ($request->input('id') == 0) {
            $venda = new Venda();
        } else {
            $venda = Venda::find($request->input('id'));
            $venda->item_vendas()->delete();
        }
        $venda->data = $request->input('data');
        $venda->cliente_id = $request->input('cliente_id');
        $venda->documento = $request->input('documento');
        $venda->forma_pagamento = $request->input('forma_pagamento');
        $produto_id = $request->input('produto_id');
        $quantidade = $request->input('quantidade');
        $itens = array();
        $valor = 0;
        if ($produto_id) {
            for($i=0;$i<count($produto_id);$i++) {
                $item = new Item_venda();
                $item->produto_id = $produto_id[$i];
                $produto = Produto::find($item->produto_id);
                $item->quantidade = $quantidade[$i];
                $item->venda_id = $venda->id;
                $item->valor_unitario = $produto->valor;
                $item->valor_total = $item->valor_unitario * $item->quantidade;
                $valor += $item->valor_total;
                $itens[] = $item;
            }
        }
        $venda->valor = $valor;
        $venda->save();
        $venda->item_vendas()->saveMany($itens);
        return redirect("/venda/listar2");
    }

    function excluir2($id) {

        $venda = Venda::find($id);
        $venda->delete();
        return redirect("/venda/listar2");
    }
}
