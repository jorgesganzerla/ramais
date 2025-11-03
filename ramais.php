<?php
function normalizar($texto) {
    // converter para minúsculas
    $texto = mb_strtolower($texto, 'UTF-8');
    // remover palavras irrelevantes comuns
    $texto = preg_replace('/\b()\b/u', '', $texto);
    // limpar múltiplos espaços
    $texto = trim(preg_replace('/\s+/', ' ', $texto));
    return $texto;
}

// Função para exibir resultado de setor/ramal/funcionários
function exibirSetor($resultado) {
    if ($resultado === false) {
        echo "<p>Erro na execução da consulta.</p>";
        return;
    }
    if ($resultado->num_rows === 0) {
        echo "<p>Nenhum resultado encontrado para a busca.</p>";
        return;
    }
    while ($row = $resultado->fetch_assoc()) {
        // Ajuste conforme os nomes exatos das colunas no banco
        $ramal = htmlspecialchars($row['ramal_do_setor']);
        $setor = htmlspecialchars($row['nome_do_setor']);
        $funcionarios = htmlspecialchars($row['funcionarios_do_setor']);
        echo "<p><strong>Ramal:</strong> $ramal &nbsp; | &nbsp; <strong>Setor:</strong> $setor &nbsp; | &nbsp; <strong>Funcionários:</strong> $funcionarios</p>";
    }
}

// Conexão
$conexao = new mysqli('localhost', 'root', '123456789', 'mydb', 3306);
if ($conexao->connect_errno) {
    echo "<p>Falha na conexão com MySQL: " . $conexao->connect_error . "</p>";
    exit();
}

// Processamento do formulário
$executa_consulta = null;
if (isset($_POST['btn_login'])) {
    if (isset($_POST['nao_sei']) && $_POST['nao_sei'] == 1) {
        // Busca por funcionário
        $funcionario = $_POST['funcionario'] ?? '';
        $funcionario_normalizado = normalizar($funcionario);
        // Consulta preparada com LIKE (tolerante)
        $stmt = $conexao->prepare("SELECT ramal_do_setor, nome_do_setor, funcionarios_do_setor FROM armazenamento WHERE LOWER(funcionarios_do_setor) LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $funcionario_normalizado);
        $stmt->execute();
        $executa_consulta = $stmt->get_result();
        $stmt->close();
    } else {
        // Busca por setor
        $setor = $_POST['setor'] ?? '';
        $setor_normalizado = normalizar($setor);
        $stmt = $conexao->prepare("SELECT ramal_do_setor, nome_do_setor, funcionarios_do_setor FROM armazenamento WHERE LOWER(nome_do_setor) LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $setor_normalizado);
        $stmt->execute();
        $executa_consulta = $stmt->get_result();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Ramais e Setores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: navy;
        }
        h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: navy;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: black;
        }
        .resultado {
            background: #fff;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h2>Ramais e Setores</h2>
    <form method="POST">
        <div id="busca_setor">
            <label for="setor">Informe o setor que você deseja contatar</label>
            <input type="text" name="setor" id="setor" placeholder="Ex: Curso de Pedagogia">
        </div>
        <div>
            <input type="checkbox" name="nao_sei" value="1" id="nao_sei" onclick="toggleBusca()">
            <label for="nao_sei">Não sei qual setor contatar</label>
        </div>
        <div id="busca_funcionario" style="display:none;">
            <label for="funcionario">Informe o nome do funcionário:</label>
            <input type="text" name="funcionario" id="funcionario" placeholder="Ex: João Silva">
        </div>
        <button type="submit" name="btn_login">Enviar</button>
    </form>
    <div class="resultado">
        <?php
        if (isset($executa_consulta)) {
            exibirSetor($executa_consulta);
        }
        ?>
    </div>
    <script>
        function toggleBusca() {
            var checkBox = document.getElementById("nao_sei");
            var buscaSetor = document.getElementById("busca_setor");
            var buscaFuncionario = document.getElementById("busca_funcionario");
            if (checkBox.checked == true) {
                buscaSetor.style.display = "none";
                buscaFuncionario.style.display = "block";
            } else {
                buscaSetor.style.display = "block";
                buscaFuncionario.style.display = "none";
            }
        }
    </script>
</body>
</html>
