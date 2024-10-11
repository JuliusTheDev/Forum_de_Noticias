@extends('template.app')

@section('conteudo')
  <h1>Lista de Noticias</h1>
  <a href="noticia/novo" class="btn btn-primary">Nova Notícia</a>
  <table class="table table-bordered table-stripped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Data</th>
      <th scope="col">Autor</th>
      <th scope="col">Título</th>
      <th scope="col">Categoria</th>
      <th scope="col">Imagem</th>
      <th scope="col">Excluir</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($noticias as $noticia)
        <tr>
        <th scope="row">{{ $noticia->id }}</th>
        <td>{{ $noticia->data->format('d/m/Y') }}</td>
        <td>{{ $noticia->autor }}</td>
        <td>{{ $noticia->titulo }}</td>
        <td>{{ $noticia->categoria->descricao }}</td>
        <td>
          @if($noticia->imagem != "")
            <img src="/storage/imagens/{{$noticia->imagem}}" style="width: 40px">
          @endif
        </td>
        <td><a href="/noticia/excluir/{{$noticia->id}}" class="btn btn-danger">-</a></td>
        <td><a href="/noticia/editar/{{$noticia->id}}" class="btn btn-primary">+</a></td>
        </tr>
    @endforeach      
  </tbody>
  </table>
@endsection