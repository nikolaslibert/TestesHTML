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
        <link href="CSS/designPrincipal.css" rel="stylesheet" type="text/css">
        <link href="CSS/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <link href="CSS/tabelaReservas.css" rel="stylesheet">
        <script src="include/jquery-1.10.2.js"></script>
        <script src="include/jquery-ui-1.10.3.custom.js"></script>
        
        <script>
        
        (function ($){
            var metodos = {
                inicializa : function(argumentos) {
                    config = $.extend({
                        teste1: "abc",
                        teste2: "cde"
                    }, argumentos );
                
                    var html = '';
                    html += '<div class="trContainer"><div class="trBg">';
                    html += '<ul><li class="trListaHorasOffset"></li>';
                    for (i = 0; i < 25; i++){
                        html += '<li>' + (i<10 ? '0'+i : i)  + ':00 -</li>';
                    }
                    html += '</ul>';
                    html += '<div class="trConteudo"></div>';
                    html += '</div></div>';
                
                    return this.html(html);
                },
                adicionaQuadra : function(idQuadras) {
                    var tabela = this.find(".trConteudo");
                    var html;
                    if (!$.isArray(idQuadras)){idQuadras=[idQuadras];}
                    $.each(idQuadras, function(i , id){
                        html = '';
                        html += '<div class="trColQuadra" numQ="'+ id +'">';
                        html += '<div class="trNomeQuadra">Quadra ' + (id+1) + '</div>';
                        html += '</div>';
                        tabela.append(html);
                    });                    
                    return this;
                },
                removeQuadra : function(idQuadras) {
                    var tabela = this.find(".trConteudo");
                    if (idQuadras === undefined){
                        tabela.empty();
                    } else {
                        if (!$.isArray(idQuadras)){idQuadras=[idQuadras];}
                        $.each(idQuadras, function(i , id){
                            tabela.find('[numQ="' + id + '"]').remove();
                        });
                    }
                    return this;
                },
                limpaQuadra : function(idQuadras) {
                    if (!idQuadras){
                        this.find(".trColQuadra").children().
                                not(".trNomeQuadra").remove();
                    } else {
                        var tabela = this.find(".trConteudo");
                        $.each(idQuadras, function(i , id){
                            tabela.find('[numQ="' + id + '"]').children().
                                    not(".trNomeQuadra").remove();
                        });
                    }
                    return this;
                },
                adicionaReserva : function(reservas) {
                    var tabela = this.find(".trConteudo");
                    var html;
                    var quadra;
                    if (!$.isArray(reservas)){reservas=[reservas];}
                    $.each(reservas, function(i, reserva){                      
                        quadra = tabela.find('[numQ="' + reserva.quadra + '"]');
                        html = '';
                        html += '<div numR="' + reserva.id + '" class="trReservado trRegistro">';
                        html += 'Reserva ' + reserva.id + '</div>';
                        quadra.append(html);
                        quadra.find('[numR="' + reserva.id + '"]').css({
                            "top":((reserva.horario)*3+3)+"em",
                            "height":((reserva.duracao)*3)+"em"
                        });
                    });
                    return this;
                }
            };

            $.fn.tabelaReservas = function(opcoes) {
                if ( metodos[opcoes] ) {
                    return metodos[ opcoes ].apply( this, Array.prototype.slice.call( arguments, 1 ));
                } else if ( typeof opcoes === 'object' || ! opcoes ) {
                    return metodos.inicializa.apply( this, arguments );
                } else {
                    $.error( 'O método ' +  opcoes + ' não existe jQuery.tabelaReservas' );
                }    
            };
        }( jQuery ));
        
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
            
            $('#tabelaReservas').tabelaReservas({
                teste1: "Fuja dos Raposões! "
            });
             
            $('#tabelaReservas').tabelaReservas('adicionaQuadra',[0,1,2]);
            $('#tabelaReservas').tabelaReservas('adicionaReserva',[
                {quadra: 0, id: 0, horario: 5, duracao: 1},
                {quadra: 0, id: 1, horario: 7, duracao: 3}
            ]);
//            function adicionaQuadra(var nomeQuadra) {
//                var html = '';
//                html += '<div class="trColQuadra">';
//                html += '<div class="trNomeQuadra">' + nomeQuadra + '</div>';
//                html += '</div>';
//                $('.trConteudo').append(html);
//            }
//                var html = '';
//                html += '<table><thead><tr><th><div>Horários</div></th>';
//                for (i = 0; i < numQuadras; i++) {
//                    html.push('<th><div>Quadra ' + i + '</div></th>');
//                }
//                html.push('</tr></thead><tbody>');
//
//                for (i = 0; i < 24; i++) {
//                    html.push('<tr><td rowspan="4">');
//                    html.push('<div>&nbsp;' + i + '</div></td>');
//                    for (j = 0; j < numQuadras; j++) {
//                        html.push('<td><div>&nbsp;0</div></td>');
//                    }
//                    html.push('</tr>');
//                    
//                    for (i2 = 0; i2 < 3; i2++){
//                        html.push('<tr>');
//                        for (j = 0; j < numQuadras; j++) {
//                            html.push('<td><div>&nbsp;0</div></td>');
//                        }
//                        html.push('</tr>');
//                    }
//                }
//                html.push('</tbody></table>');
//                return html.join('');
//            }
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
                    <div id="tabelaReservas"></div>                    
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
