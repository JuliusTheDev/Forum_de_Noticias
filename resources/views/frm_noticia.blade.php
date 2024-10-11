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

  <h1>Formulário de Noticia</h1>
  <form action="/noticia/salvar" method="POST" enctype="multipart/form-data">
    @csrf    
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input readonly type="text" class="form-control" id="id" name="id" value="{{$noticia->id}}">
    </div>
    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{old('data', $noticia->data)}}">
    </div>
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="{{old('autor', $noticia->autor)}}">
    </div>
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="{{old('titulo', $noticia->titulo)}}">
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3">
            {{old('descricao', $noticia->descricao)}}
        </textarea>
    </div>
    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-control" name="categoria_id" id="categoria_id">
            @foreach($categorias as $categoria)
                <option 
                    @if ($categoria->id == old('categoria_id', $noticia->categoria_id) ) 
                        selected
                    @endif
                value="{{$categoria->id}}">{{$categoria->descricao}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="arquivo" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="arquivo" name="arquivo">
    </div>


    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
@endsection  