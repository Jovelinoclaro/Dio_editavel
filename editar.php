<?php
include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o id!</div>"];
} elseif (empty($dados['dio_fibra'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário enviar o e-mail!</div>"];
}else {
    $query_usuario = "UPDATE ala SET dio_fibra=:dio_fibra, dio_a=:dio_a, dio_b=:dio_b, dio_c=:dio_c WHERE id=:id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':dio_fibra', $dados['dio_fibra']);
    $edit_usuario->bindParam(':dio_a', $dados['dio_a']);
    $edit_usuario->bindParam(':dio_b', $dados['dio_b']);
    $edit_usuario->bindParam(':dio_c', $dados['dio_c']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Dio editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: 501 contato com Desenvolvedor!</div>"];
    }    
}

echo json_encode($retorna);
