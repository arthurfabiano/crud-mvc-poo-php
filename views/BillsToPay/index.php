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
    <?php if(!empty($returnMessage)): ?>
        <div class="box-message">
            <p><?= $returnMessage ?></p>
            <button class="btn-close-message" onclick="reload()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
    <?php endif; ?>
    <h1>Listar Contas a Pagar</h1>
    <form action="index.php">
        <input class="input" type="search" name="search" placeholder="Pesquisar">
        <input type="hidden" name="a" value="search">
        <input type="hidden" name="searchBillsToPay" value="billstopay">
        <input class="button" type="submit" name="submit" value="Localizar">
    </form>
    <div>
        <div> <a class="button" href="./index.php?c=companies">Lista Empresa</a> </div>
        <div><a class="button btn-success" href="./index.php?a=goToNew&c=billstopay">Nova Conta a Pagar</a></div>
    </div>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Valor</th>
                    <th>Data Pagamento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultData as $data): ?>
                    <tr>
                        <td> <?= $data["id"]; ?> </td>
                        <td> <?= $data["nameEmpresa"]; ?> </td>
                        <td> <?= 'R$ ' . $data["valor"]; ?> </td>
                        <td> <?= date( 'd/m/Y' , strtotime( $data["data_pagar"])); ?> </td>
                        <td> <?= $data["pago"] ? "<div class='txt-success'>Efetuado</div>" : "<div class='txt-danger'>Pendente</div>"; ?> </td>
                        <td>
                            <a class="button btn-edit" href="./index.php?c=billstopay&emp=<?= $data['nameEmpresa'] ?>&a=search&v=editCreate&search=<?= $data['id'] ?>">Editar</a>
                            <button class="button btn-delete" onclick="verifyDelete(<?= $data['id'] ?>)">Deletar</button> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function verifyDelete(id)
    {
        let result = confirm('Você tem certeza que deseja deletar o registro com id: '+id);
        console.log(result);
        if(result)
        {
            window.location.replace('./index.php?c=billstopay&a=delete&id='+id);
        }
    }
    function reload()
    {
        window.location.replace('index.php');
    }
</script>
</html>