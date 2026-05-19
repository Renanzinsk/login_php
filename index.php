<?php
$status_login = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_digitado = $_POST['email'] ?? '';
    $senha_digitada = $_POST['senha'] ?? '';

    $email_digitado = trim($email_digitado);
    $senha_digitada = trim($senha_digitada);

    $regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (empty($email_digitado) || empty($senha_digitada)) {
        $status_login = 'erro';
    } 
    elseif (!preg_match($regex_email, $email_digitado)) {
        $status_login = 'erro';
    } 
    else {
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

        // Define o status final
        if ($acesso_liberado) {
            $status_login = 'sucesso';
        } else {
            $status_login = 'erro';
        }
    }
}
?>

<?php if ($status_login === 'sucesso'): ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Sucesso</title>
        <style>
            body {
                background-color: #4CAF50; /* Verde */
                color: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
            }
            h1 { font-size: 3rem; text-transform: uppercase; }
            a { color: white; text-decoration: underline; margin-top: 20px; font-size: 1.2rem; }
        </style>
    </head>
    <body>
        <h1>usuario correto</h1>
        <a href="index.php">Sair / Voltar</a>
    </body>
    </html>

<?php elseif ($status_login === 'erro'): ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Erro</title>
        <style>
            body {
                background-color: #F44336; /* Vermelho */
                color: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
            }
            h1 { font-size: 3rem; text-transform: uppercase; }
            a { color: white; text-decoration: underline; margin-top: 20px; font-size: 1.2rem; }
        </style>
    </head>
    <body>
        <h1>usuario invalido</h1>
        <a href="index.php">Tentar Novamente</a>
    </body>
    </html>

<?php else: ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de Login</title>
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
            h2 { text-align: center; color: #333; margin-top: 0; }
            .campo { margin-bottom: 15px; }
            label { display: block; margin-bottom: 5px; color: #555; }
            input[type="text"], input[type="password"] {
                width: 100%; padding: 10px; border: 1px solid #ccc;
                border-radius: 4px; box-sizing: border-box; 
            }
            button {
                width: 100%; padding: 10px; background-color: #0056b3;
                color: white; border: none; border-radius: 4px;
                cursor: pointer; font-size: 16px;
            }
            button:hover { background-color: #004494; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Acesso ao Sistema</h2>
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
<?php endif; ?>