

<?php
$servername = "localhost";
$username = "root"; // Seu usuário do MySQL
$password = "admin"; // Sua senha do MySQL
$dbname = "plano";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para validar e limpar entrada
function validar_entrada($entrada) {
    $entrada = trim($entrada);
    $entrada = stripslashes($entrada);
    $entrada = htmlspecialchars($entrada);
    return $entrada;
}

// Variável para armazenar o status do cadastro
$status = "";

// Processar o formulário se for enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e limpar os dados recebidos
    $plano = validar_entrada($_POST['unimed']);
    $area_atuacao = validar_entrada($_POST['areaAtuacao']);
    $nome = validar_entrada($_POST['nome']);
    $cpf = validar_entrada($_POST['cpf']);
    $sexo = validar_entrada($_POST['sexo']);
    $data_nascimento = validar_entrada($_POST['dataNascimento']);
    $telefone = validar_entrada($_POST['telefone']);
    $celular = validar_entrada($_POST['celular']);
    $email_unimed = validar_entrada($_POST['emailUnimed']);
    $email_particular = validar_entrada($_POST['emailParticular']);
    $senha = validar_entrada($_POST['senha']);
    
    // Criptografar a senha antes de armazenar no banco de dados
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar e executar a consulta SQL
    $sql = "INSERT INTO clientes (plano, area_atuacao, nome, cpf, sexo, data_nascimento, telefone, celular, email_unimed, email_particular, senha) 
            VALUES ('$plano', '$area_atuacao', '$nome', '$cpf', '$sexo', '$data_nascimento', '$telefone', '$celular', '$email_unimed', '$email_particular', '$senha_hash')";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página final.php após o cadastro
        header("Location: final.php");
        exit(); // Certifique-se de que nenhum código adicional seja executado após o redirecionamento
    } else {
        $status = "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Saúde+</title>
    <link rel="stylesheet" href="/style/cadastro.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signup-form">
                <h2>Cadastre-se no Saúde+</h2>
                <div class="form-group">
                    <label for="unimed">Seu plano</label>
                    <select id="unimed" name="unimed" required>
                        <option value="">Selecione</option>
                        <option value="básico">Básico</option>
                        <option value="intermediário">Intermediário</option>
                        <option value="avançado">Avançado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="areaAtuacao">Área de Atuação</label>
                    <select id="areaAtuacao" name="areaAtuacao" required>
                        <option value="">Selecione</option>
                        <option value="Área 1">Área 1</option>
                        <option value="Área 2">Área 2</option>
                        <option value="Área 3">Área 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" id="dataNascimento" name="dataNascimento" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>
                <div class="form-group">
                    <label for="celular">Telefone Celular</label>
                    <input type="tel" id="celular" name="celular" required>
                </div>
                <div class="form-group">
                    <label for="emailUnimed">E-mail do Sistema Unimed</label>
                    <input type="email" id="emailUnimed" name="emailUnimed" required>
                </div>
                <div class="form-group">
                    <label for="emailParticular">E-mail Particular</label>
                    <input type="email" id="emailParticular" name="emailParticular">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn">Cadastrar</button>
                <div class="status"><?php echo $status; ?></div>
            </form>
        </div>
    </div>
</body>
</html>
