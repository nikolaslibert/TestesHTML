<?php
$emailVazio = true;
$emailJaExiste = true;
$senhaVazia = true;
$senhasDiferentes = true;
$cpfVazio = true;
$cnpjVazio = true;
$nomeVazio = true;
$sobrenomeVazio = true;
$nascimentoVazio = true;

// Verifica se página foi aberta a partir do botão de cadastro
if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST") {
    
// Verifica consistência dos dados informados
    if ($_POST["user"]=="") {
    $userIsEmpty = true;
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
                if ($(this).val() ==="CPF"){
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
                            <input type="text" name="email" id="email" placeholder="E-mail"/>
                            <span class="caixaErro" id="erroEmail">
                                <?php
                                
                                ?>
                            </span>
                        </p>
                        <p style="position: relative;">
                            <label for="senha1">Senha: </label><br>                            
                            <input type="password" name="senha1" id="senha1" placeholder="Senha"/>
                            <span class="caixaErro" id="erroSenha1"></span>
                        </p>
                        <p style="position: relative;">
                            <label for="senha2">Confirme sua senha: </label><br>
                            <input type="password" name="senha2" id="senha2" placeholder="Confirme sua senha"/>
                            <span class="caixaErro" id="erroSenha2"></span>
                        </p>
                        <p style="position: relative;">
                            <label for="rCPF">CPF
                            <input type="radio" name="tipoId" value="CPF" checked="checked" maxlength="9"/>
                            </label>
                            <label for="rCNPJ">CNPJ
                            <input type="radio" name="tipoId" value="CNPJ" maxlength="11"/>
                            </label>
                            <br>
                            (somente números)
                            <br>
                            <input type="text" name="cpf" placeholder="CPF" id="cpf" maxlength="9"/>
                            <input type="text" name="cnpj" placeholder="CNPJ" id="cnpj" maxlength="11" style="display: none;"/>
                            <span class="caixaErro" id="erroId"></span>
                        </p>
                        <p style="position: relative;">
                            <label for="nome">Nome: </label><br>
                            <input type="text" name="nome" id="nome" placeholder="Nome"/>
                            <span class="caixaErro" id="erroNome"></span>
                        </p>
                        <p class="jQpF" style="position: relative;">
                            <label for="sobrenome">Sobrenome: </label><br>
                            <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome"/>
                            <span class="caixaErro" id="erroSobrenome"></span>
                        </p>
                        <p class="jQpF" style="position: relative;">
                            <label for="nascimento">Nascimento (DD/MM/AAAA): </label><br>
                            <input type="text" name="nascimento" id="nascimento" placeholder="DD/MM/AAAA" maxlength="10"/>
                            <span class="caixaErro" id="erroNascimento"></span>
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
