<?php
include_once('cnx.php');
include_once('gravar_verificacao.php');
include_once('app/gravar_verificacao.php');
include_once('app/selectProdutos.php');
include_once('app/carrinho.php');
if (!isset($_SESSION['UsuarioID'])) header('Location: index.php');


$pnome = $_POST['pnome'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$telefone = $_POST['telefone'];


// Adicione uma linha para cada item de dados
echo "<tr><td>pnome</td><td> ".$pnome."</td></tr>";
echo "<tr><td>endereco</td><td> ".$endereco."</td></tr>";
echo "<tr><td>cidade</td><td> ".$cidade."</td></tr>";
echo "<tr><td>telefone</td><td> ".$telefone."</td></tr>";



//header("Location: index.php");

if (count($_SESSION['carrinho']) == 0) {
    echo "<tr><th scope='row'>Nenhum produto selecionado</th>";
} else {

    foreach ($_SESSION['carrinho'] as $id => $qtd) {

        $resultado = mysqli_query($cnx, "select *from produtos where id = $id") or die (mysqli_error());
        $data = mysqli_fetch_assoc($resultado);
        $produto = $data['id'];
        $preco = number_format($data['precoUnitario'], 2, ',', '.');
        $total = number_format($data['precoUnitario'] * $qtd, 2, ',', '.');
        $total_final += $data['precoUnitario'] * $qtd;
        $final = $total_final;



// Crie a consulta INSERT
        $sql = "insert into `pedido` (`cidade`, `endereco`,  `idprodutos`, `idusuarios`,  `qtd`, `telefone`) 
values ('$cidade', '$endereco',   $produto, $Sid,  $qtd, '$telefone')";



        if (mysqli_query($cnx, $sql)) {
            // Se a consulta for bem-sucedida, redirecione para a homepage
            header("Location: index.php");
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($cnx);
        }
    }
}

$_SESSION['carrinho']=0;
// Feche a conexão com o banco de dados
mysqli_close($cnx);