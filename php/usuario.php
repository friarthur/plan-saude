<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obter os dados do usuário logado
$email_unimed = $_SESSION['email_unimed'];
$sql = "SELECT * FROM clientes WHERE email_unimed = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email_unimed);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Exibir as informações do usuário
    echo "<h2>Bem-vindo, " . $user['nome'] . "!</h2>";
    echo "<p>Plano: " . $user['plano'] . "</p>";
    echo "<p>Área de Atuação: " . $user['area_atuacao'] . "</p>";
    echo "<p>CPF: " . $user['cpf'] . "</p>";
    echo "<p>Sexo: " . $user['sexo'] . "</p>";
    echo "<p>Data de Nascimento: " . $user['data_nascimento'] . "</p>";
    echo "<p>Telefone: " . $user['telefone'] . "</p>";
    echo "<p>Celular: " . $user['celular'] . "</p>";
    echo "<p>E-mail Unimed: " . $user['email_unimed'] . "</p>";
    echo "<p>E-mail Particular: " . $user['email_particular'] . "</p>";
} else {
    echo "Nenhum dado encontrado.";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Perfil do Usuário</h1>
    <p>Bem-vindo, <?php echo htmlspecialchars($user['nome']); ?>!</p>
    
    <ul>
        <li><strong>Plano:</strong> <?php echo htmlspecialchars($user['plano']); ?></li>
        <li><strong>Área de Atuação:</strong> <?php echo htmlspecialchars($user['area_atuacao']); ?></li>
        <li><strong>Nome:</strong> <?php echo htmlspecialchars($user['nome']); ?></li>
        <li><strong>CPF:</strong> <?php echo htmlspecialchars($user['cpf']); ?></li>
        <li><strong>Sexo:</strong> <?php echo htmlspecialchars($user['sexo']); ?></li>
        <li><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($user['data_nascimento']); ?></li>
        <li><strong>Telefone:</strong> <?php echo htmlspecialchars($user['telefone']); ?></li>
        <li><strong>Celular:</strong> <?php echo htmlspecialchars($user['celular']); ?></li>
        <li><strong>E-mail Unimed:</strong> <?php echo htmlspecialchars($user['email_unimed']); ?></li>
        <li><strong>E-mail Particular:</strong> <?php echo htmlspecialchars($user['email_particular']); ?></li>
    </ul>

    <a href="login.php">Sair</a>
</body>
</html>