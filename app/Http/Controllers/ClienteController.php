<?php

namespace App\Http\Controllers;

use App\Mail\Mensagem;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    //
    function listar() {
        $clientes = Cliente::all();
        return view("listagem_cliente", compact('clientes'));
    }

    function mensagem($id) {
        $cliente = Cliente::find($id);
        return view("formulario_mensagem", compact('cliente'));
    }

    function enviarMensagem(Request $request) {
        $id = $request->input('id');
        $cliente = Cliente::find($id);
        $mensagem = $request->input('mensagem');
        Mail::to($cliente->email)->send(new Mensagem($cliente, $mensagem));
        return redirect("/cliente/listar");
    }
}
