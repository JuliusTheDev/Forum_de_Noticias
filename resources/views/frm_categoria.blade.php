@extends('template.app')

@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif  
  <h1>Formulário de Categoria</h1>
  @if($categoria->imagem != "")
    <img src="/storage/imagens/{{$categoria->imagem}}" style="width: 200px">
  @endif

  <form action="/categoria/salvar" method="POST" enctype="multipart/form-data">
    @csrf    
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input readonly type="text" class="form-control" id="id" name="id" value="{{$categoria->id}}">
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control @error('descricao') border-danger @enderror" id="descricao" name="descricao" value="{{ old('descricao', $categoria->descricao) }}">
        @error('descricao')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror        
    </div>
    <div class="mb-3">
        <label for="arquivo" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="arquivo" name="arquivo">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
@endsection