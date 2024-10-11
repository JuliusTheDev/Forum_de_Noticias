<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Item_venda;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Venda;
class VendaController extends Controller
{
    function listar() {
        $vendas = Venda::all();
        return view("listagem_venda", compact('vendas') );
    }

    function novo() {
        $venda = new Venda();
        $venda->data = now();
        $venda->id = 0;
        $venda->valor = 0;
        $clientes = Cliente::orderBy('nome')->get();
        return view('formulario_venda', compact('venda', 'clientes'));
    }

    function salvar(Request $request) {
        if ($request->input('id')==0) {
            $venda = new Venda();
            $venda->valor = 0;
        } else {
            $venda = Venda::find($request->input('id'));
        }
        $venda->data = $request->input('data');
        $venda->cliente_id = $request->input('cliente_id');
        $venda->documento = $request->input('documento');
        $venda->forma_pagamento = $request->input('forma_pagamento');

        $venda->save();
        return redirect('/venda/listar');
    }

    function editar($id) {
        $venda = Venda::find($id);
        $clientes = Cliente::orderBy('nome')->get();
        return view('formulario_venda', compact('venda', 'clientes'));
    }

    function editarItens($id) {
        $produtos = Produto::orderBy('descricao')->get();
        $venda = Venda::find($id);
        $clientes = Cliente::orderBy('nome')->get();
        return view('formulario_venda_itens', compact('venda', 'clientes', 'produtos'));
    }    

    function salvarItens(Request $request) {
        $venda_id = $request->input('venda_id');
        $venda = Venda::find($venda_id);
        $item = new Item_venda();
        $item->produto_id = $request->input('produto_id');
        $item->quantidade = $request->input('quantidade');
        $produto = Produto::find($item->produto_id);
        $item->valor_unitario = $produto->valor;
        $item->valor_total = $item->quantidade * $item->valor_unitario;
        $venda->valor = $venda->valor + $item->valor_total;
        $venda->save();
        $venda->item_vendas()->save($item);
        return redirect("/venda/editarItens/".$venda->id);
        
    }

    function deleteItem(Request $request) {
        $venda = Venda::find($request->input("venda_id"));        
        $item = Item_venda::find($request->input("id"));
        if ($item->venda_id == $request->input('venda_id')) {
            $venda->valor -= $item->valor_total;
            $item->delete();
            $venda->save();
        }
        return redirect("/venda/editarItens/".$venda->id);
    }

    function excluir($id) {
        $venda = Venda::find($id);
        $venda->delete();
        return redirect("/venda/listar");
    }
}
