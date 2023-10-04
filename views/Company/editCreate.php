<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/index.css">
    <title>Clients</title>
</head>
<body>
    <a class="button btn-back" href="index.php">Voltar</a>
    <h1>Companies</h1>
    <div class="content">
        <form action="index.php?c=companies" method="POST">
            <div class="input-box">
                <label for="name">Nome:</label>
                <input class="input" type="text" placeholder="Nome da Empresa" value="<?= isset($resultData[0]['name']) ? $resultData[0]['name'] : '' ?>" name="name" required>
            </div>
            <br><br>
            <input type="hidden" name="a" value="<?= isset($resultData[0]['id']) ? 'edit' : 'new' ?>">
            <input type="hidden" name="id" value="<?= isset($resultData[0]['id']) ? $resultData[0]['id'] : '' ?>">
            <input class="button btn-search" type="submit" name="submit" value="Salvar/Atualizar">
        </form>
    </div>
</body>
</html>