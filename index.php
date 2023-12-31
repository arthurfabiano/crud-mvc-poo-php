<?php

    $nameController = isset($_GET['c']) ? $_GET['c'] . 'Controller' : 'CompaniesController';
    if (isset($_GET['searchBillsToPay'])) $nameController = 'BillsToPayController';

    include_once ('./controllers/'.$nameController.'.php');
    // require_once('./controllers/CompaniesController.php');

    $controller = new $nameController();

    $action = (isset($_GET['a']) || isset($_POST['a'])) ? (isset($_POST['a']) ? $_POST['a'] : $_GET['a']) : 'getAll';
    $message = isset($_GET['m']) ? $_GET['m'] : '';
    $status = !empty($_GET['s']) ? $_GET['s'] : '';

    if(!empty($message) && isset($_GET['s']))
    {
        $messages = [
            'edit' => ['editado','editar'],
            'delete' => ['deletado','deletar'],
            'update' => ['atualizado','atualizar'],
            'insert' => ['inserido','inserir']
        ];
        $controller->{$action}($messages[$message][0],$messages[$message][1],$status);
    }
    else if($action == "delete")
    {
        $id = $_GET['id'];
        $controller->{$action}($id);
    }
    else if($action == "search")
    {
        $data = $_GET['search'];
        $view = isset($_GET['v']) ? $_GET['v'] : 'index';
        if(empty($data))
        {
            $controller->getAll();
        }
        else
        {
            $controller->{$action}($data,$view);
        }
    }
    else if($action == "edit")
    {
        $controller->{$action}($_POST);
    }
    else if($action == "new")
    {
        $controller->{$action}($_POST);
    }
    else
    {
        $controller->{$action}();
    }