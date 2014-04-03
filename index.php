<?php
header('Server: ');
header('X-Powered-By: ');

require_once("include/db.php");

$email = "";
$erroLogin = false;

// Verifica se página foi aberta a partir do botão de cadastro
if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $erroLogin = true;
    } else {
        $senha = filter_input(INPUT_POST, "senha", FILTER_UNSAFE_RAW);
        // Verifica e-mail e senha
        $idUsuario = agendamentoDB::getInstance()->autentica($email,$senha);
        if ($idUsuario){
            session_start();
            session_regenerate_id();            
            $_SESSION['user'] = $idUsuario;
            $_SESSION['tIni'] = date('d/m/y U');
            
            $paramGet = '?';
            if (SID!=NULL){
                $paramGet = htmlspecialchars(SID) . '&';
            }
            $paramGet .= 'esporte=' . md5('Tempo: ' . $_SESSION['tIni']);
            // Verifica se o usuário é administrador de alguma quadra
            if (agendamentoDB::getInstance()->usuarioAdministrador($idUsuario)){                
                header('Location: indexAdministrador.php' . $paramGet);
                exit();
            } else {                
                header('Location: indexUsuario.php' . $paramGet);
                exit();
            }
        } else {
            $erroLogin = true;
        }
    }
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/designPrincipal.css">
        <title></title>
    </head>
    <body>
        <!--------------------------------------------------------------------->        
        <div id="containerCabecalho">
            <div class="leiauteColunaPrincipal">
                <div id="cabecalhoTitulo">
                    <h1 id="cabecalhoTitulo">Quadra Online</h1>
                </div>
                
                <div id="cabecalhoLogin">
                    <p>Login</p>
                </div>
            </div>
        </div>
        <!--------------------------------------------------------------------->
        
        <!--------------------------------------------------------------------->
        <div id="containerConteudo">
            <div class="leiauteColunaPrincipal">
                <div id="conteudo">
                    <div id="conteudoEsq">
                        <h1>Do futebol à cancha de bocha...</h1>
                        <h2>Achar o local pro seu esporte nunca foi tão fácil.</h2>
                        <form action="index.php" name="login" method="POST">
                            <?php
                                if($erroLogin){
                                    echo '<p>E-mail ou senha incorretos</p>';
                                }
                            ?>
                            <p>
                                <input type="text" name="email" placeholder="E-mail" text="<?php echo email; ?>" class="campoTexto"/>
                            </p>
                            <p>
                                <input type="password" name="senha" placeholder="Senha" class="campoTexto"/>
                            </p>
                            <p>
                                <input type="submit" value="Fazer Login" name="btoLogin" />
                            </p>
                        </form>
                        <p>Novo por aqui? Faça seu <a href="cadastrar.php" class="linkPadrao">cadastro</a> de graça!</p>
                    </div>

                    <div id="conteudoDir">
                        <h1>Mapa</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------------------------------------------------------->
        
        <!--------------------------------------------------------------------->
        <div id="containerRodape">
            <div class="leiauteColunaPrincipal">
                <p>Todos direitos reservados para Barbosa e a <em>Máfia do Queijo</em>.</p>
            </div>
        </div>
        <!--------------------------------------------------------------------->
        
        
    </body>
</html>
