<?php
session_start();
require_once("funcoes.php");

$botaoRegistrar = filter_input(INPUT_POST, 'botaoRegistrar');

if ($botaoRegistrar) {
    
    require_once 'conexao.php';
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $dados["senha"] = password_hash($dados["senha"], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO usuario (nome, nascimento, celular, login, senha, nivel) VALUES (?, ?, ?, ?, ?, '2')"; 
    
    if($stmt = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($stmt, 'sssss', $param_usu_nome, $param_usu_nascimento, $param_usu_celular, $param_usu_login, $param_usu_senha);

        $param_usu_nome = $dados['nome'];
        $param_usu_nascimento = $dados['dataNascimento'];
        $param_usu_celular = $dados['celular'];
        $param_usu_login = $dados['email'];
        $param_usu_senha = $dados['senha'];

        if(mysqli_stmt_execute($stmt)){
            mysqli_commit($conexao);
            mysqli_stmt_close($stmt);
            mysqli_close($conexao);

            $_SESSION['msgcad'] = "Usuário cadastrado com sucesso!";
            header("location: home.php");
            exit;
        } else {
            $_SESSION['msg'] = "Erro ao cadastrar o usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Cliente</title>
    <link rel="stylesheet" href="CadastroCliente.css" />
    <script defer src="CadastroCliente.js"></script>
</head>
<body>
    <div class="ConteudoSite">
        <div class="titulo">
            <h1 id="CadastroTitulo">Cadastra-se</h1>
        </div>
        <div class="form">
            <form method="POST" action="Cadastro.php">
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php if (isset($_POST['nome'])) { echo $_POST['nome']; } ?>" required>
                    </div>

                    <div class="input-box">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required minlength="8">
                    </div>

                    <div class="input-box">
                        <label for="dataNascimento">Data de Nascimento:</label>
                        <input id="dataNascimento" type="date" name="dataNascimento" min="2006-01-01" required>
                    </div>

                    <div class="input-box">
                        <label for="celular">Celular:</label>
                        <input id="celular" type="tel" name="celular" required>
                    </div>

                    <div class="input-box">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" required>
                    </div>

                    <div class="Botao">
                        <button type="submit" name="botaoRegistrar">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
