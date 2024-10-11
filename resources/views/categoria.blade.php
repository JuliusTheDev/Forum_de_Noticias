@extends('template.app')

@section('conteudo')
  <h1>Lista de Categorias</h1>
    <a href="categoria/novo" class="btn btn-primary">Nova Categoria</a>
    <a href="categoria/pdf" class="btn btn-primary">Salvar em PDF</a>
    <table class="table table-bordered table-stripped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Descrição</th>
        <th scope="col">Imagem</th>

        <th scope="col">Excluir</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($categorias as $categoria)
          <tr>
          <th scope="row">{{ $categoria->id }}</th>
          <td>{{ $categoria->descricao }}</td>
          <td>
          @if($categoria->imagem != "")
            <img src="/storage/imagens/{{$categoria->imagem}}" style="width: 40px">
          @endif
          </td>
          <td><a href="/categoria/excluir/{{$categoria->id}}" class="btn btn-danger">-</a></td>
          <td><a href="/categoria/editar/{{$categoria->id}}" class="btn btn-primary">+</a></td>
          </tr>
      @endforeach      
    </tbody>
  </table>
@endsection