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
        <?php
        // put your code here
        ?>
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
                    <form name="cadastrar" method="POST">
                        <p>
                            <label>E-mail: </label><br>
                            <input type="text" name="email" placeholder="E-mail" class="campoTexto"/>
                        </p>
                        <p>
                            <label>Senha: </label><br>                            
                            <input type="password" name="senha1" placeholder="Senha" class="campoTexto"/>
                        </p>
                        <p>
                            <label>Confirme sua senha: </label><br>
                            <input type="password" name="senha2" placeholder="Confirme sua senha" class="campoTexto"/>
                        </p>
                        <p>
                            <label>CPF </label><input type="radio" name="Pessoa" value="CPF" checked="checked" />
                            <label>CNPJ </label><input type="radio" name="Pessoa" value="CNPJ"/>
                            <br>
                            <label>(somente números)</label>
                            <br>
                            <input type="text" name="cpf" placeholder="CPF" class="campoTexto"/>
                        </p>
                        <p>
                            <label>Nome: </label><br>
                            <input type="text" name="nome" placeholder="Nome" class="campoTexto"/>
                        </p>
                        <p>
                            <label>Sobrenome: </label><br>
                            <input type="text" name="sobrenome" placeholder="Sobrenome" class="campoTexto"/>
                        </p>
                        <p>
                            <label>Nascimento (DD/MM/AAAA): </label><br>
                            <input type="text" name="nascimento" placeholder="Sobrenome" class="campoTexto"/>
                        </p>
                        <p>
                            <input type="submit" value="Fazer Login" name="btoLogin" />
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
