<?php
header('Server: ');
header('X-Powered-By: ');

require_once("include/db.php");

$email = "";
$senha1 = "";
$senha2 = "";
$pessoaFisica = true;
$cpf = "";
$cnpj = "";
$nome = "";
$sobrenome = "";
$nascimento = "";

$erroEmail = "";
$erroSenha1 = "";
$erroSenha2 = "";
$erroId = "";
$erroNome = "";
$erroSobrenome = "";
$erroNascimento = "";
$erroRegistro = false;

// Verifica se página foi aberta a partir do botão de cadastro
if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST") {
    
// Verifica consistência dos dados informados
    // E-mail
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $erroRegistro = true;
        $erroEmail .= 'Endereço Inválido.';
    } else {
        // Verifica se e-mail já existe
        if (agendamentoDB::getInstance()->emailCadastrado($email)){
            $erroRegistro = true;
            $erroEmail .= 'Este e-mail já está cadastrado.';
        }
    }
    
    // Senhas
    $senha1 = filter_input(INPUT_POST, "senha1", FILTER_UNSAFE_RAW);
    $senha2 = filter_input(INPUT_POST, "senha2", FILTER_UNSAFE_RAW);
    if ($senha1 === "") {
        $erroRegistro = true;
        $erroSenha1 .= 'Digite uma senha.';
    } elseif ($senha1 !== $senha2) {
        $erroRegistro = true;
        $erroSenha2 .= 'As senhas devem ser iguais.';
    }
    
    // Nome
    $nome = filter_input(INPUT_POST, "nome", FILTER_UNSAFE_RAW);
    if ($nome === "") {
        $erroRegistro = true;
        $erroNome .= 'Campo Obrigatório.';
    }
    
    // Verifica se é pessoa física ou jurídica
    if (filter_input(INPUT_POST, "tipoId", FILTER_UNSAFE_RAW) === "CNPJ") {
        $pessoaFisica = false;        
    }
    
    if ($pessoaFisica){
        //CPF
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_VALIDATE_REGEXP,
                array("options" => array("regexp"=>"/^[0-9]{11}$/")));
        if (!$cpf) {
            $erroRegistro = true;
            $erroId .= 'Campo Obrigatório.';
        } else {
            // Verifica se CPF é válido.
        }
        
        //Sobrenome
        $sobrenome = filter_input(INPUT_POST, "sobrenome", FILTER_UNSAFE_RAW);
        if ($sobrenome === "") {
            $erroRegistro = true;
            $erroSobrenome .= 'Campo Obrigatório.';
        }
        
        //Nascimento
        $nascimento = filter_input(INPUT_POST, "nascimento", FILTER_VALIDATE_REGEXP,
                array("options" => array("regexp"=>"/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/")));
        if (!$nascimento) {
            $erroRegistro = true;
            $erroNascimento .= 'Campo Obrigatório.';
        } else {            
            $nascDMA = sscanf($nascimento,"%u/%u/%u");
            
            //Verifica se data é válida
            if (checkdate($nascDMA[1], $nascDMA[0], $nascDMA[2])==false){
                $erroRegistro = true;
                $erroNascimento .= 'Data Inválida.';
            }
        }
    } else {
        //CNPJ
        $cnpj = filter_input(INPUT_POST, "cnpj", FILTER_VALIDATE_REGEXP,
                array("options" => array("regexp"=>"/^[0-9]{14}$/")));
        
        if (!$cnpj) {
            $erroRegistro = true;
            $erroId .= 'Campo Obrigatório.';
        } else {
            // Verifica se CNPJ é válido
        }               
    }
    
    if (!$erroRegistro){
        if ($pessoaFisica){
            $idUsuario = agendamentoDB::getInstance()->criaPessoaFisica(
                    $email, $senha1, $cpf, $nome, $sobrenome, $nascDMA);
        } else {
            $idUsuario = agendamentoDB::getInstance()->criaPessoaJuridica(
                    $email, $senha1, $cnpj, $nome);
        }
    }
    
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
        header('Location: indexUsuario.php' . $paramGet);
        exit();
    } else {
        $erroEmail .= 'Erro desconhecido no banco de dados.';
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
        <script src="include/jquery-1.10.2.js"></script>
        <title></title>
        
        <script>
        $(document).ready(function(){                       
            $("input[name=tipoId]").change(function(){
                if ($("input[name=tipoId]:checked").val() ==="CPF"){
                    $(".jQpJ, #cnpj").hide();
                    $("#cnpj").prop('disabled', true);
                    $(".jQpF, #cpf").show();
                    $(".jQpF input, #cpf").prop('disabled', false);
               } else {
                    $(".jQpF, #cpf").hide();
                    $(".jQpF input, #cpf").prop('disabled', true);
                    $(".jQpJ, #cnpj").show();
                    $("#cnpj").prop('disabled', false);
               }
            });           
            
            $("input[name=tipoId]").change();
            
            $("#senha1").keyup(function(){
                if ($("#senha2").val() !== ""){
                    if ($("#senha1").val() !== $("#senha2").val()){
                        $("#erroSenha2").text("As senhas devem ser iguais.");
                    } else {
                        $("#erroSenha2").text("");
                    }
                }
            });
            
            $("#senha2").keyup(function(){
                if ($("#senha1").val() !== $("#senha2").val()){
                    $("#erroSenha2").text("As senhas devem ser iguais.");
                } else {
                    $("#erroSenha2").text("");
                }
            });
            
            $("form[name='cadastrar']").submit(function(event){
                var erros=false;
                
                if($("#email").val() === ""){
                    $("#erroEmail").text("Campo obrigatório");
                    erros=true;
                } else {
                    $("#erroEmail").text("");
                }
                
                if($("#senha1").val() === ""){
                    $("#erroSenha1").text("Campo obrigatório");
                    erros=true;
                } else {
                    $("#erroSenha1").text("");
                }                
                $("#senha2").keyup();
                                
                if($("#nome").val() === ""){
                    $("#erroNome").text("Campo obrigatório");
                    erros=true;
                } else {
                    $("#erroNome").text("");
                }
                
                if($("input[name=tipoId]:checked").val() === "CPF"){
                    if($("#cpf").val() === ""){
                        $("#erroId").text("Campo obrigatório");
                        erros=true;
                    } else {
                        $("#erroId").text("");
                    }
                    
                    if($("#sobrenome").val() === ""){
                        $("#erroSobrenome").text("Campo obrigatório");
                        erros=true;
                    } else {
                        $("#erroSobrenome").text("");
                    }
                    
                    if($("#nascimento").val() === ""){
                        $("#erroNascimento").text("Campo obrigatório");
                        erros=true;
                    } else {
                        $("#erroNascimento").text("");
                    }
                } else {
                    if($("#cnpj").val() === ""){
                        $("#erroId").text("Campo obrigatório");
                        erros=true;
                    } else {
                        $("#erroId").text("");
                    }
                }
                
                if (erros===true){
                   event.preventDefault();
                }
            });
            
        });
        </script>     
        
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
                    <h1>Cadastro</h1>
                    <form action="cadastrar.php" name="cadastrar" method="POST">
                        <p style="position: relative;">
                            <label for="email">E-mail: </label><br>
                            <input type="text" name="email" id="email" placeholder="E-mail"
                                   value="<?php echo htmlspecialchars($email); ?>"/>
                            <span class="caixaErro" id="erroEmail"><?php echo $erroEmail;?></span>
                        </p>
                        <p style="position: relative;">
                            <label for="senha1">Senha: </label><br>                            
                            <input type="password" name="senha1" id="senha1" placeholder="Senha"
                                   value="<?php echo htmlspecialchars($senha1); ?>"/>
                            <span class="caixaErro" id="erroSenha1"><?php echo $erroSenha1;?></span>
                        </p>
                        <p style="position: relative;">
                            <label for="senha2">Confirme sua senha: </label><br>
                            <input type="password" name="senha2" id="senha2" placeholder="Confirme sua senha"
                                   value="<?php echo htmlspecialchars($senha2); ?>"/>
                            <span class="caixaErro" id="erroSenha2"><?php echo $erroSenha2;?></span>
                        </p>
                        <p style="position: relative;">
                            <label for="rCPF">CPF
                            <input type="radio" name="tipoId" value="CPF" maxlength="11" <?php
                                if ($pessoaFisica){
                                    echo 'checked="checked"';
                                }
                                ?>/>
                            </label>
                            <label for="rCNPJ">CNPJ
                            <input type="radio" name="tipoId" value="CNPJ" maxlength="14" <?php
                                if (!$pessoaFisica){
                                    echo 'checked="checked"';
                                }
                                ?>/>
                            </label>
                            <br>
                            (somente números)
                            <br>
                            <input type="text" name="cpf" placeholder="CPF" id="cpf" maxlength="11" <?php
                                echo 'value="'.htmlspecialchars($cpf).'"';
                                if (!$pessoaFisica){
                                    echo ' style="display: none;"';
                                    echo ' disabled';
                                }
                                ?>/>
                            <input type="text" name="cnpj" placeholder="CNPJ" id="cnpj" maxlength="14" <?php
                                echo 'value="'.htmlspecialchars($cnpj).'"';
                                if ($pessoaFisica){
                                    echo ' style="display: none;"';
                                    echo ' disabled';
                                }
                                ?>/>
                            <span class="caixaErro" id="erroId"><?php echo $erroId;?></span>
                        </p>
                        <p style="position: relative;">
                            <label for="nome">Nome: </label><br>
                            <input type="text" name="nome" id="nome" placeholder="Nome"
                                   value="<?php echo htmlspecialchars($nome); ?>"/>
                            <span class="caixaErro" id="erroNome"><?php echo $erroNome;?></span>
                        </p>
                        <p class="jQpF" style="position: relative;<?php
                            if(!$pessoaFisica){
                                echo ' display: none;';
                            }
                            ?>">
                            <label for="sobrenome">Sobrenome: </label><br>
                            <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" maxlength="45" <?php
                                echo 'value="'.htmlspecialchars($sobrenome).'"';
                                if (!$pessoaFisica){
                                    echo ' disabled';
                                }
                                ?>/>
                            <span class="caixaErro" id="erroSobrenome"><?php echo $erroSobrenome;?></span>
                        </p>
                        <p class="jQpF" style="position: relative;<?php
                            if(!$pessoaFisica){
                                echo ' display: none;';
                            }
                            ?>">
                            <label for="nascimento">Nascimento (DD/MM/AAAA): </label><br>
                            <input type="text" name="nascimento" id="nascimento" placeholder="DD/MM/AAAA" maxlength="10" <?php
                                echo 'value="'.htmlspecialchars($nascimento).'"';
                                if (!$pessoaFisica){
                                    echo ' disabled';
                                }
                                ?>/>
                            <span class="caixaErro" id="erroNascimento"><?php echo $erroNascimento;?></span>
                        </p>
                        <p>
                            <input type="submit" value="Cadastrar" name="btoCadastrar" />
                        </p>
                    </form>
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
