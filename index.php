<?php

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["txtNome"];
    $valorCompra = floatval($_POST["txtValorCompra"]);
    $formaPagamento = $_POST["cmbPag"];

    $desconto = 0;
    $percentual = 0;
    $nomePagamento = "";

    // Verifica a forma de pagamento e calcula o desconto
    if ($formaPagamento == "deposito") {

        $percentual = 10;
        $desconto = $valorCompra * 0.10;
        $nomePagamento = "Depósito";

    } elseif ($formaPagamento == "boleto") {

        $percentual = 8;
        $desconto = $valorCompra * 0.08;
        $nomePagamento = "Boleto";

    } elseif ($formaPagamento == "cartaoCredito") {

        $percentual = 0;
        $desconto = 0;
        $nomePagamento = "Cartão de crédito";

    } else {

        $mensagem = "Forma de pagamento inválida.";
    }

    // Calcula o valor final da compra
    if ($nomePagamento != "") {

        $valorFinal = $valorCompra - $desconto;

        $valorCompraFormatado = number_format(
            $valorCompra,
            2,
            ",",
            "."
        );

        $descontoFormatado = number_format(
            $desconto,
            2,
            ",",
            "."
        );

        $valorFinalFormatado = number_format(
            $valorFinal,
            2,
            ",",
            "."
        );

        $mensagem = "
            Olá, <strong>$nome</strong>!<br><br>

            Valor da compra:
            <strong>R$ $valorCompraFormatado</strong><br>

            Forma de pagamento:
            <strong>$nomePagamento</strong><br>

            Desconto:
            <strong>$percentual% (R$ $descontoFormatado)</strong><br>

            Valor final:
            <strong>R$ $valorFinalFormatado</strong>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Madeira e Cia - Promoção</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <h1>Madeira e Cia Ltda.</h1>

        <p class="subtitulo">
            Promoção especial de aniversário
        </p>

        <form method="POST" action="">

            <label for="txtNome">
                Nome do cliente:
            </label>

            <input
                type="text"
                name="txtNome"
                id="txtNome"
                placeholder="Digite seu nome"
                required
            >

            <label for="txtValorCompra">
                Valor da compra:
            </label>

            <input
                type="number"
                name="txtValorCompra"
                id="txtValorCompra"
                placeholder="Ex.: 1500.00"
                step="0.01"
                min="0"
                required
            >

            <label for="cmbPag">
                Forma de pagamento:
            </label>

            <select
                name="cmbPag"
                id="cmbPag"
                required
            >

                <option value="">
                    Selecione uma opção
                </option>

                <option value="deposito">
                    Depósito - 10% de desconto
                </option>

                <option value="boleto">
                    Boleto - 8% de desconto
                </option>

                <option value="cartaoCredito">
                    Cartão de crédito - sem desconto
                </option>

            </select>

            <button type="submit">
                Calcular desconto
            </button>

        </form>

        <?php if ($mensagem != ""): ?>

            <div class="resultado">
                <?php echo $mensagem; ?>
            </div>

        <?php endif; ?>

    </div>

</body>

</html>