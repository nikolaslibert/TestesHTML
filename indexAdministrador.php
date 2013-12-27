<?php
//session_start();
//$codigoSessao = md5('Tempo: ' . $_SESSION['tIni']);
//if(filter_input(INPUT_GET, "esporte", FILTER_UNSAFE_RAW) !== $codigoSessao){
//    $_SESSION = array();
//    if (isset($_COOKIE[session_name()])) {
//        setcookie(session_name(), '', time()-42000, '/');
//    }
//    session_destroy();
//    
//    header('Location: index.php');
//    exit();
//}
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
        <link href="CSS/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <script src="include/jquery-1.10.2.js"></script>
        <script src="include/jquery-ui-1.10.3.custom.js"></script>
        
        <script>
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                onSelect: function(Data, Inst){
                    $("h2").text(Data);
                }
            });
            
            $('#tabelaHorarios').html(criaTabela(3));
            
            function criaTabela(numQuadras) {
                var html = [];
                html.push('<table><thead><tr><th><div>Horários</div></th>');
                for (i = 0; i < numQuadras; i++) {
                    html.push('<th><div>Quadra ' + i + '</div></th>');
                }
                html.push('</tr></thead><tbody>');

                for (i = 0; i < 24; i++) {
                    html.push('<tr><td rowspan="4">');
                    html.push('<div>&nbsp;' + i + '</div></td>');
                    for (j = 0; j < numQuadras; j++) {
                        html.push('<td><div>&nbsp;0</div></td>');
                    }
                    html.push('</tr>');
                    
                    for (i2 = 0; i2 < 3; i2++){
                        html.push('<tr>');
                        for (j = 0; j < numQuadras; j++) {
                            html.push('<td><div>&nbsp;0</div></td>');
                        }
                        html.push('</tr>');
                    }
                }
                html.push('</tbody></table>');
                return html.join('');
            }
        });
        
//        $(document).ready(function (){           
//            var currentDate = $("#datepicker").datepicker("getDate");
//            $("h2").text(currentDate);
//        });        
        </script>
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
        <div id="containerMenuHorizontal">
            <div class="leiauteColunaPrincipal">
                <div class="menuHorizontal">
                    <ul>
                        <li><a class="active" href="">Reservas</a></li>
                        <li><a href="">Quadras</a></li>
                        <li><a href="">Configurações</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--------------------------------------------------------------------->
        
        <!--------------------------------------------------------------------->
        <div id="containerConteudo">
            <div class="leiauteColunaPrincipal">
                <div id="conteudoEsq">
                    <h1>Do futebol à cancha de bocha...</h1>
                    <h2>Achar o local pro seu esporte nunca foi tão fácil.</h2>
                    <div id="datepicker"></div>
                    
                </div>
                
                <div id="conteudoDir">
                    <h1>Mapa</h1>
                    <div id="tabelaHorarios"></div>                    
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
