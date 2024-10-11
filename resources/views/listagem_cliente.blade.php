@extends('template.app')

@section('conteudo')
  <h1>Lista de Clientes</h1>
    <table class="table table-bordered table-stripped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">E-mail</th>

        <th scope="col">Mensagem</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($clientes as $cliente)
          <tr>
          <th scope="row">{{ $cliente->id }}</th>
          <td>{{ $cliente->nome }}</td>
          <td>{{ $cliente->email }}</td>
          <td><a href="/cliente/mensagem/{{$cliente->id}}" class="btn btn-primary">Mensagem</a></td>
          </tr>
      @endforeach      
    </tbody>
  </table>
@endsection