<!DOCTYPE html>
<html>
<head>
    <title>Encomenda</title>
</head>
<body>
<h2>Encomenda</h2>
<?php
  if(isset($_POST['nome']) && isset($_POST['endereco']) && isset($_POST['telefone'])){
   $nome = $_POST['nome'];
   $endereco = $_POST'endereco';
   $telefone = $_POST'telefone';

   echo "<table>
     <tr>
      <th>Nome</th>
      <th>Endereço</th>
      <th>Telefone</th>
     </tr>
     <tr>
      <td>$nome</td>
      <td>$endereco</td>
      <td>$telefone</td>
     </tr>
    </table>";
  }
  ?>
</body>
</html>