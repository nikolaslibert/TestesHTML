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
            var eventos = {
                adicionaQuadra: function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    event.data.find(".trContainerCxSelQ").show();
                },
                fechaCxSelQ: function(event) {            
                    event.preventDefault();
                    event.stopPropagation();
                    event.data.find(".trContainerCxSelQ").hide();
                },
                fechaQuadra : function(event) {            
                    event.preventDefault();
                    event.stopPropagation();
                    var numQ = $(this).closest("div.trColQuadra").attr("numQ");
                    metodos.removeQuadra.call(event.data,numQ);
                }
            };
            
            var metodos = {
                inicializa : function(argumentos) {
                    config = $.extend({
                        espacamento: 3,
                        offsetPrimeiraLinha: 1.5
                    }, argumentos.config);
                    this.data(config);
                    
                    var listaHoras = "";
                    for (i = 0; i < 25; i++){
                        listaHoras += '<li>' + (i<10 ? '0'+i : i)  + ':00 -</li>';
                    }
                    
                    var cxSelQ = $('<div/>').addClass("trCxSelQ");
                    
                    $('<div/>').addClass("trContainer").
                    append(
                        $('<div/>').addClass("trBg").
                        append(
                            $('<ul/>').
                            append(
                                $('<li/>').addClass("trListaHorasOffset")).
                            append(
                                listaHoras)
                        ).
                        append(
                            $('<div/>').addClass("trConteudo").
                            append(
                                $('<div/>').addClass("trContainerCxSelQ").
                                hide().
                                append(
                                    cxSelQ
                                )
                            ).
                            append(
                                $('<div/>').addClass("trColUlt").
                                append(
                                    $('<a href="">+</a>').addClass("trBtnNovaQuadra tr")
                                )
                            )
                        )
                    ).appendTo(this);
                    
                    cxSelQ.
                    append(
                        $('<div/>').addClass('trCxSelQTitulo').
                        append(
                            'Quadras Visíveis'
                        ).
                        append(
                            $('<a href="">X</a>').
                            addClass('trBtnFechaCxSelQ tr')
                        )
                    ).
                    append(
                        $('<h2/>').text("Não há quadras cadastradas.")
                    );
                    
                    var cssDinamico ='.trContainer ul li{';
                    cssDinamico += 'height: ' +
                            config.espacamento +'em;';
                    cssDinamico += 'line-height: ' +
                            config.espacamento + 'em;}';
                    cssDinamico += '.trContainer ul .trListaHorasOffset{';
                    cssDinamico += 'height: ' +
                            config.offsetPrimeiraLinha + 'em;}';
                    cssDinamico += 'div.trColQuadra{';
                    cssDinamico += 'height: ' +
                            (config.offsetPrimeiraLinha+config.espacamento*24.5) + 'em;}';
                    cssDinamico += 'div.trBgQuadra{';
                    cssDinamico += 'height: ' +
                            config.espacamento*24 + 'em;';
                    cssDinamico += 'top: ' +
                            (config.offsetPrimeiraLinha+config.espacamento/2) + 'em;}';
                    $('<style>' + cssDinamico + '</style>').appendTo( "head" );

                    if (argumentos.quadras !== undefined){
                        metodos.adicionaQuadra.call(this,argumentos.quadras);
                    }
                    
                    this.find(".trConteudo").on("click","a.trBtnFechaQuadra",this,eventos.fechaQuadra);
                    this.find(".trBtnNovaQuadra").on("click",this,eventos.adicionaQuadra);
                    this.find(".trBtnFechaCxSelQ").on("click",this,eventos.fechaCxSelQ);
                    
                    return this;
                },
                adicionaQuadra : function(quadras) {
                    var ultimaColuna = this.find(".trColUlt");
                    var contexto = this;
                    if (!$.isArray(quadras)){quadras=[quadras];}
                    
                    $.each(quadras, function(i , quadra){
                        $('<div/>').addClass('trColQuadra').attr('numQ',quadra.numSeq).
                        append(
                            $('<div/>').addClass('trNomeQuadra').
                            append(
                                'Quadra ' + (quadra.numSeq+1)
                            ).
                            append(
                                $('<a href="">X</a>').
                                addClass('trBtnFechaQuadra tr')
                            )
                        ).
                        append(
                            $('<div/>').addClass('trBgQuadra')
                        ).
                        insertBefore(ultimaColuna).
                        data('id', quadra.id);
                        
                        if (quadra.registros !== undefined){
                            metodos.adicionaRegistro.call(contexto,{
                                registros: quadra.registros,
                                numSeq: quadra.numSeq
                            });
                        }
                
                    });                    
                    return this;
                },
                removeQuadra : function(idQuadras) {
                    if (idQuadras === undefined){
                        this.find(".trColQuadra").remove();
                    } else {
                        var tabela = this.find(".trConteudo");
                        if (!$.isArray(idQuadras)){idQuadras=[idQuadras];}
                        $.each(idQuadras, function(i , id){
                            tabela.find('[numQ="' + id + '"]').remove();
                        });
                    }
                    return this;
                },
                limpaQuadra : function(idQuadras) {
                    if (idQuadras === undefined){
                        this.find(".trColQuadra").find(".trRegistro").remove();
                    } else {
                        if (!$.isArray(idQuadras)){idQuadras=[idQuadras];}
                        var tabela = this.find(".trConteudo");
                        $.each(idQuadras, function(i , id){
                            tabela.find('[numQ="' + id + '"]').
                                    find(".trRegistro").remove();
                        });
                    }
                    return this;
                },
                adicionaRegistro : function(Argumentos) {
                    var quadra = this.find(".trConteudo").
                            find('[numQ="' + Argumentos.numSeq + '"]');
                    var esp = this.data("espacamento");
                    var offset = this.data("offsetPrimeiraLinha");
                    var registros=Argumentos.registros;
                    if (!$.isArray(registros)){registros=[registros];}
                    $.each(registros, function(i, registro){                      
                        var elemento = $('<div/>').addClass('trRegistro').
                                css({
                                    "top":((registro.hora)*esp+offset+esp/2) + "em",
                                    "height":((registro.tempo)*esp) + "em"
                                });
                        if (registro.id !== undefined){
                            elemento.data('id',registro.id).
                                    text('reservado').
                                    addClass('trReservado');
                        } else {
                            elemento.addClass('trIndisponivel');
                        }
                        quadra.append(elemento);
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
                config: {
                    espacamento: 2,
                    offsetPrimeiraLinha: 2
                },
                quadras: [
                    {id: 123, numSeq: 0,
                    registros: [
                        {hora: 8, tempo: 0.5, id: 14},
                        {hora: 11, tempo: 3, id: 10},
                        {hora: 0, tempo: 8},
                        {hora: 23, tempo: 1}
                    ]},
                    {id: 375, numSeq: 1,
                    registros: [
                        {hora: 8, tempo: 0.5, id: 11},
                        {hora: 11, tempo: 3, id: 18},
                        {hora: 0, tempo: 8},
                        {hora: 23, tempo: 1}
                    ]}
                ]
            });
             
            $('#tabelaReservas').tabelaReservas('adicionaQuadra',
                    {id: 124, numSeq: 2,
                    registros: [
                        {hora: 8, tempo: 0.5, id: 114},
                        {hora: 11, tempo: 3, id: 110},
                        {hora: 0, tempo: 8},
                        {hora: 23, tempo: 1}
                    ]});
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
                <div id="conteudo">
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
