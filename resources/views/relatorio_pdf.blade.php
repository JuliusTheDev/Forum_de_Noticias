<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio de Categoria</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid black;
            padding: 0.5rem;
        }
        th {

        }

    </style>
</head>
<body>
<h1>Lista de Categorias</h1>
    <table>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Descrição</th>
        <th scope="col">Imagem</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($categorias as $categoria)
          <tr>
          <th scope="row">{{ $categoria->id }}</th>
          <td>{{ $categoria->descricao }}</td>
          <td>
          @if($categoria->imagem != "")
            <img src='{{storage_path("app/public/imagens/".$categoria->imagem)}}' style="width: 40px">
          @endif
          </td>
          </tr>
      @endforeach      
    </tbody>
  </table>    
</body>
</html>