<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/index.css">
    <title>Contas a Pagar</title>
</head>
<body>
    <a class="button btn-back" href="index.php">Voltar</a>
    <h1>Contas a Pagar</h1>
    <div class="content">
        <form action="index.php?c=billstopay" method="POST">
            <?php if (isset($resultData[0]['id'])) { ?>
            <div class="input-box">
                <label>Nome Empresa</label><br>
                <input class="input" type="text" placeholder="Escoha a Empresa" value="<?= isset($resultData[0]['name']) ? $resultData[0]['name'] : '' ?>" name="name" readonly>
            </div>
            <?php } else {?>
                <div class="input-box">
                    <label>Nome Empresa</label><br>
                    <select class="select" name="id_empresa">
                        <option value="">Escoha a Empresa</option>
                        <?php foreach ($companies as $emp): ?>
                            <option value="<?= $emp['id'] ?>"><?= $emp['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input class="input" type="text" placeholder="Escoha a Empresa" value="<?= isset($resultData[0]['name']) ? $resultData[0]['name'] : '' ?>" name="name" required>-->
                </div>
            <?php } ?>
            <br><br>
            <div class="input-box">
                <label>Vencimento</label><br>
                <input class="input" type="date" placeholder="Data de Pagamento" value="<?= isset($resultData[0]['data_pagar']) ? $resultData[0]['data_pagar'] : '' ?>" name="data_pagar" id="vencimento" required>
            </div>
            <br><br>
            <div class="input-box">
                <label>Valor</label><br>
                <input class="input" type="text" placeholder="Digite o Valor" value="<?= isset($resultData[0]['valor']) ? $resultData[0]['valor'] : '' ?>" name="valor" id="valor" required>
            </div>
            <br><br>
            <?php if (isset($resultData[0]['id'])) { ?>
            <div class="input-box">
                <label>Valor a Pagar</label><br>
                <input class="input" type="text" placeholder="Valor a Pagar" value="<?= isset($resultData[0]['valor']) ? $resultData[0]['valor'] : '' ?>" id="pagamento" readonly>
            </div>
            <br><br>

            <div class="input-box">
                <label>Staus de Pagamento</label><br>
                <select class="select" name="pago">
                    <option value="">Estado do pagamento</option>
                    <option value="1" <?= ($resultData[0]['pago'] == 1) ? 'selected' : '' ?>>Efetuado</option>
                    <option value="0" <?= ($resultData[0]['pago'] == 0) ? 'selected' : '' ?>>Pendente</option>
                </select>
            </div>
            <br><br>
            <?php } ?>

            <input type="hidden" name="a" value="<?= isset($resultData[0]['id']) ? 'edit' : 'new' ?>" <?= isset($resultData[0]['id']) ?>>
            <input type="hidden" name="id" value="<?= isset($resultData[0]['id']) ? $resultData[0]['id'] : '' ?>">
            <input class="button btn-search" type="submit" name="submit" value="Salvar/Atualizar">
        </form>
    </div>
<script>

    function compareDates (date) {
        let replace = date.replaceAll('-', '/')
        let parts = replace.split('/')
        let join = `${parts[2]},${parts[1]},${parts[0]}`
        let vencimento = join.replaceAll(',', '/')
        let today = new Date().toLocaleString().substr(0, 10) // pega a data atual

        // compara se a data informada é maior que a data atual
        // e retorna true ou false
        if (vencimento < today)
            return valor - (valor * (5/100))
        else if (vencimento > today)
            return valor + (valor * (10/100))
        if (vencimento === today)
           return valor;
    }

    let vencimento = document.querySelector("#vencimento").value
    let valor = parseFloat(document.querySelector("#valor").value)
    let result = parseFloat(compareDates(vencimento, valor)).toFixed(2) // Retorna false

    document.getElementById("pagamento").value = result;
</script>
</body>
</html>