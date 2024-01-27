<?php
include_once "conexao.php";



$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    //Calcular o inicio visualização
    $qnt_result_pg = 40; //Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_usuarios = "SELECT id, dio_fibra, dio_a, dio_b, dio_c FROM ala ORDER BY id LIMIT $inicio, $qnt_result_pg";
    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->execute();

    if (($result_usuarios) and ($result_usuarios->rowCount() != 0)) {

        $dados = "<div class='table-responsive'>
            <table class='table table-striped table-bordered table-sm'>
                <thead><caption><i class='bi bi-cup-hot'></i> <i class='bi bi-wrench-adjustable'></i> 2024</caption>
                    <tr>
                        
                        <th>Fibra</th>
                        <th>Equipamento</th>
                        <th>Circuito</th>
                        <th>Statos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            extract($row_usuario);
            // ...

            $dados .= "<tr>
<td id='valor_dio_fibra$id'>$dio_fibra</td>
<td id='valor_dio_a$id'>$dio_a</td>
<td id='valor_dio_b$id'>$dio_b</td>
<td id='valor_dio_c$id'>$dio_c</td>
<td class='d-flex'>                        
    <button type='button' id='botao_editar$id' class='btn btn-warning btn-sm me-1' onclick='editar_registro($id)'>Editar</button>
    <button type='button' id='botao_salvar$id' class='btn btn-danger btn-sm me-1' onclick='salvar_registro($id)'  style='display: none;'>Salvar</button>
</td>
</tr>";

            // ...


        }

        $dados .= "</tbody>
        </table>
    </div>";

        //Paginação - Somar a quantidade de usuários
        $query_pg = "SELECT COUNT(id) AS num_result FROM ala";
        $result_pg = $conn->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        $max_links = 2;

        $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

        $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarUsuarios(1)'>Primeira</a></li>";

        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_ant)' >$pag_ant</a></li>";
            }
        }

        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
            }
        }

        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";
        $dados .= '</ul></nav>';

        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}


echo json_encode($retorna);
