<?php
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_digitado = $_POST['email'] ?? '';
    $senha_digitada = $_POST['senha'] ?? '';

    $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (!preg_match($regex_email, $email_digitado)) {
        $mensagem = "<p class='erro'>Formato de e-mail inválido!</p>";
    } else {
        $arquivo_json = file_get_contents('usuarios.json');
        $usuarios = json_decode($arquivo_json, true);

        $acesso_liberado = false;

        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                if ($usuario['email'] === $email_digitado && $usuario['senha'] === $senha_digitada) {
                    $acesso_liberado = true;
                    break; 
                }
            }
        }

        if ($acesso_liberado) {
            $mensagem = "<p class='sucesso'>Acesso liberado! Bem-vindo.</p>";
        } else {
            $mensagem = "<p class='erro'>E-mail ou senha incorretos.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login Simples</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }
        .campo {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #004494;
        }
        .sucesso {
            color: green;
            text-align: center;
            font-weight: bold;
        }
        .erro {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Acesso ao Sistema</h2>
        
        <?php echo $mensagem; ?>

        <form action="index.php" method="POST">
            <div class="campo">
                <label for="email">E-mail:</label>

                <input type="text" name="email" id="email" required>
            </div>

            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>