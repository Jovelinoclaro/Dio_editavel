/* Inicio listar os registros do banco de dados */
const tbody = document.querySelector(".listar-usuarios");

// Funcao para listar os registros do banco de dados
const listarUsuarios = async (pagina) => {

    // Fazer a requisicao para o arquivo PHP responsavel em recuperar os registros do banco de dados
    const dados = await fetch("./list.php?pagina=" + pagina);

    // Ler o objeto retornado pelo arquivo PHP
    const resposta = await dados.json();

    // Acessa o IF quando nao encontrar nenhum registro no banco de dados
    if (!resposta['status']) {
        // Envia a mensagem de erro para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        // Recuperar o SELETOR do HTML que deve receber os registros
        const conteudo = document.querySelector(".listar-usuarios");

        // Somente acessa o IF quando existir o SELETOR ".listar-usuarios"
        if (conteudo) {

            // Enviar os dados para o arquivo HTML
            conteudo.innerHTML = resposta['dados'];
        }
    }
}

// Chamar a funcao para listar os registro do banco de dados
listarUsuarios(1);

/* Fim listar os registros do banco de dados */


/* Inicio substituir o texto pelo campo na tabela */
// Funcao responsavel em substituir o texto pelo campo na tabela e receber o ID do registro que sera editado

function editar_registro(id) {
    // Ocultar o botao editar
    document.getElementById("botao_editar" + id).style.display = "none";

    // Apresentar o botao salvar
    document.getElementById("botao_salvar" + id).style.display = "block";

    // Recuperar os valores do registro que esta na tabela
    var dio_fibra = document.getElementById("valor_dio_fibra" + id);
    var dio_a = document.getElementById("valor_dio_a" + id);
    var dio_b = document.getElementById("valor_dio_b" + id);
    var dio_c = document.getElementById("valor_dio_c" + id);

    // Substituir o texto pelo campo e atribuir para o campo o valor que estava na tabela
    dio_fibra.innerHTML = "<input type='text' id='dio_fibra_text" + id + "' value='" + dio_fibra.innerHTML + "' size='1' >";
    dio_a.innerHTML = "<input type='text' id='dio_a_text" + id + "' value='" + dio_a.innerHTML + "' size='40' >";
    dio_b.innerHTML = "<input type='text' id='dio_b_text" + id + "' value='" + dio_b.innerHTML + "' size='40' >";
    dio_c.innerHTML = "<input type='text' id='dio_c_text" + id + "' value='" + dio_c.innerHTML + "' size='2' >";

}

/* Fim substituir o texto pelo campo na tabela */

/* Inicio editar o registro no banco de dados */
// Funcao resposavel em salvar no banco de dados e receber o id do registro que deve ser editado

async function salvar_registro(id) {
    // Recuperar os valore dos campos
    var dio_fibra_valor = document.getElementById("dio_fibra_text" + id).value;
    var dio_a_valor = document.getElementById("dio_a_text" + id).value;
    var dio_b_valor = document.getElementById("dio_b_text" + id).value;
    var dio_c_valor = document.getElementById("dio_c_text" + id).value;

    // Prepara a STRING de valores que deve ser enviado para o arquivo PHP responsavel em salvar no banco de dados
    var dadosForm = "id=" + id + "&dio_fibra=" + dio_fibra_valor + "&dio_a=" + dio_a_valor + "&dio_b=" + dio_b_valor + "&dio_c=" + dio_c_valor;

    // Fazer a requisicao com o FETCH para um arquivo PHP e enviar atraves do metodo POST os dados do formulario
    const dados = await fetch("editar.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: dadosForm
    });

    // Ler o objeto, a resposta do arquivo PHP
    const resposta = await dados.json();

    // Acessa o IF quando nao conseguir editar no banco de dados
    if (!resposta['status']) {
        // Envia a mensagem de erro para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        // Envia a mensagem de sucesso para o arquivo HTML que deve ser apresentada para o usuario
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];

        // Chamar a funcao para remover a mensagem apos alguns segundos
        removerMsgAlerta();

        // Substituir os campos pelo texto que estava nos campos
        document.getElementById("valor_dio_fibra" + id).innerHTML = dio_fibra_valor;
        document.getElementById("valor_dio_a" + id).innerHTML = dio_a_valor;
        document.getElementById("valor_dio_b" + id).innerHTML = dio_b_valor;
        document.getElementById("valor_dio_c" + id).innerHTML = dio_c_valor;

        // Apresentar o botao editar
        document.getElementById("botao_editar" + id).style.display = "block";

        // Ocultar o botao salvar
        document.getElementById("botao_salvar" + id).style.display = "none";
    }
}

/* Fim editar o registro no banco de dados */

/* Inicio remover a mensagem em 5 segundos apos apresentar a mensagem para o usuario */
function removerMsgAlerta() {
    setTimeout(function () {
        // Substituir a mensagem
        document.getElementById("msgAlerta").innerHTML = "";
    }, 5000);
}
/* Fim remover a mensagem em 5 segundos apos apresentar a mensagem para o usuario */