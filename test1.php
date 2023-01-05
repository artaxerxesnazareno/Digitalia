<?php

include_once('app/gravar_verificacao.php');
include_once('app/selectProdutos.php');
include_once('app/carrinho.php');
if (!isset($_SESSION['UsuarioID'])) header('Location: index.php');


?>
<!--<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
<h1>Checkout</h1>

<form action="test2.php" method="POST">
    Nome: <input type="text" name="nome"><br>
    Endereço: <input type="text" name="endereco"><br>
    Telefone: <input type="text" name="telefone"><br>
    <input type="submit" value="Fazer encomenda">
</form>
</body>
</html>-->

<?php

if (count($_SESSION['carrinho']) == 0) {
    echo "<tr><th scope='row'>Nenhum produto selecionado</th>";
} else {

    foreach ($_SESSION['carrinho'] as $id => $qtd) {

        $resultado = mysqli_query($cnx, "select *from produtos where id = $id") or die (mysqli_error());
        $data = mysqli_fetch_assoc($resultado);
        $produto = $data['nome'];
        $preco = number_format($data['precoUnitario'], 2, ',', '.');
        $total = number_format($data['precoUnitario'] * $qtd, 2, ',', '.');
        $total_final += $data['precoUnitario'] * $qtd;
        $final = $total_final;

        echo "
                                            <tr class='cart_item'>
                                                <td class='product-name'>
                                                $produto <strong class='product-quantity'>× $qtd</strong> </td>
                                                <td class='product-total'>
                                                    <span class='amount'>kz $total</span> </td>
                                            </tr>";
    }
}
?>