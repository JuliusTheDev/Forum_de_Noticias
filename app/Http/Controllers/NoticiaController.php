<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Categoria;
use App\Http\Requests\NoticiaRequest;


class NoticiaController extends Controller
{
    //
    function listar() {
        $noticias = Noticia::orderBy('data')->get();
        return view('noticia', compact('noticias'));
    }

    function novo() {
        $noticia = new Noticia();
        $noticia->id = 0;

        $categorias = Categoria::orderBy('descricao')->get();

        return view('frm_noticia', compact('noticia', 'categorias'));
    }

    function salvar(NoticiaRequest $request) {
        if ($request->input("id") == 0) {
            $noticia = new Noticia();
        } else {
            $noticia = Noticia::find($request->input('id'));
        }

        if ($request->hasFile("arquivo")) {
            $arquivo = $request->file("arquivo");
            $caminho_arquivo = $arquivo->store('public/imagens');
            $vetor_arquivo = explode('/', $caminho_arquivo);
            $noticia->imagem = $vetor_arquivo[2];
        }

        $noticia->data = $request->input('data');
        $noticia->autor = $request->input('autor');
        $noticia->titulo = $request->input('titulo');
        $noticia->descricao = $request->input('descricao');
        $noticia->categoria_id = $request->input('categoria_id');
        $noticia->save();
        return redirect('/noticia');
    }

    function editar($id) {
        $noticia = Noticia::find($id);

        $categorias = Categoria::orderBy('descricao')->get();

        return view('frm_noticia', compact('noticia', 'categorias'));
    }

    function excluir($id) {
        $noticia = Noticia::find($id);
        $noticia->delete();
        return redirect('/noticia');        
    }
}
