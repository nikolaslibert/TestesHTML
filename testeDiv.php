<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <style>
/*            .tabelaReservas{
                float: left;
                position: relative;
                width: 100%;
                outline: blue solid thin;
            }
            .trContainer{
                text-align: center;
                float: right;
                position: relative;
                right: 50%;
                font-size: 0.75em;
            }
            
            .trBg{
                float: left;
                position: relative;
                left: 50%;
                outline: black solid thin;
                padding: 1em;
                background-color: #ccc;
            }
            
            .trContainer ul{
                float: left;
                list-style:none;
                margin:0;
                padding: 0em 0em;
            }
            .trContainer ul li{
                height: 3em;
                line-height: 3em;
            }
            .trContainer ul .trListaHorasOffset{
                height: 1.5em;
            }
            
            .trIndisponivel{
                background-color: black;
            }
            
            .trReservado{
                background-color: gray;
            }
            
            .trRegistro{
                position: absolute;
                width: 100%;
            }
            
            #r1{
                top: 36em;
                height: 3em;
            }
            #r2{
                top: 9em;
                height: 1.5em;
            }
            #r3{
                top: 3em;
                height: 1.5em;
            }
            #r4{
                top: 3em;
                height: 18em;
            }
            .trConteudo{
                float: left;
            }
            div.trColQuadra{
                //margin-left: 1em;
                position: relative;
                float: left;
                height: 74.5em; //2.5em+3*24
                //max-width: 12em;
                min-width: 8em;
            }
            div.trBgQuadra{
                position: absolute;
                top: 3em;
                height: 74.5em;
                width: 100%;
                background-color: blue; 
            }
            div.trColUlt{
                float: left;
                width: 4em;
                padding: 0.25em;
            }
            
            div.trNomeQuadra{
                position: relative;
                outline: black thin solid;
                background-color: #555;
                padding: 0.75em;
                font-size: 1em;
                color: #ffffff;
            }
            
            a.tr{
                color: white;
                display: block;
                text-align: center;
                font-weight: bold;
                text-decoration: none;
            }
            a.trBtnNovaQuadra{
                margin-left: auto;
                margin-right: auto;
                width: 1em;
                height: 1em;
                line-height: 1em;
                font-size: 2em;
            }
            a.trBtnFechaQuadra{
                width: 1em;
                height: 1.1em;
                line-height: 1.1em;
                font-size: 0.7em;
                position: absolute;
                top: 0px;
                right: 2px;
            }
            a.tr:hover,
            a.tr:active{
                color: black;
                background-color:white;
            }*/
            .tabelaReservas{
                float: left;
                position: relative;
                width: 100%;
                outline: blue solid thin;
            }
            .trContainer{
                text-align: center;
                float: right;
                position: relative;
                right: 50%;
                font-size: 0.75em;
            }

            .trBg{
                float: left;
                position: relative;
                left: 50%;
                //outline: black solid thin;
                padding: 1em;
                //background-color: #ccc;
            }

            .trContainer ul{
                float: left;
                list-style:none;
                margin:0;
                padding: 0em 0em;
            }
            .trContainer ul li{
                height: 3em;
                line-height: 3em;
            }
            .trContainer ul .trListaHorasOffset{
                height: 1.5em;
            }

            .trIndisponivel{
                background-color: black;
            }

            .trReservado{
                background-color: gray;
            }

            .trRegistro{
                position: absolute;
                width: 100%;
                border-bottom: thin dotted white;
                border-top: thin dotted white;
            }

            .trConteudo{
                float: left;
            }
            div.trColQuadra{
                margin-left: 0.5em;
                position: relative;
                float: left;
                height: 74.5em; //2.5em+3*24
                min-width: 8em;
            }
            div.trBgQuadra{
                position: absolute;
                top: 3em;
                height: 48em;
                width: 100%;
                background-color: #006699;
                border-bottom: thin dotted white;
                border-top: thin dotted white;
            }
            div.trNomeQuadra{
                outline: black thin solid;
                background-color: #555;
                padding: 0.75em;
                font-size: 1em;
                color: #ffffff;
            }
            div.trColUlt{
                float: left;
                width: 4em;
                padding: 0.25em;
            }
            a.trBtnNovaQuadra{
                margin-left: auto;
                margin-right: auto;
                line-height: 1em;
                font-size: 2em;
            }
            a.trBtnFechaQuadra{
                line-height: 1.1em;
                font-size: 0.7em;
                position: absolute;
                top: 0px;
                right: 2px;
            }
            a.tr{
                width: 1em;
                display: block;
                text-align: center;
                font-weight: bold;
                text-decoration: none;
            }

            a.tr:link,
            a.tr:visited{
                color: white;
            }
            a.tr:hover,
            a.tr:active{
                color: black;
                background-color:white;
            }
            
        </style>
        
    </head>
    <body>
        <?php
        // put your code here
        ?>
        
        <div id="tabelaReservas">
            <div class="trContainer">
                <div class="trBg">
                    <ul>
                        <li class="trListaHorasOffset" style="height: 2em; line-height: 2em;"></li>
                        <li style="height: 2em; line-height: 2em;">00:00 -</li>
                        <li style="height: 2em; line-height: 2em;">01:00 -</li>
                        <li style="height: 2em; line-height: 2em;">02:00 -</li>
                        <li style="height: 2em; line-height: 2em;">03:00 -</li>
                        <li style="height: 2em; line-height: 2em;">04:00 -</li>
                        <li style="height: 2em; line-height: 2em;">05:00 -</li>
                        <li style="height: 2em; line-height: 2em;">06:00 -</li>
                        <li style="height: 2em; line-height: 2em;">07:00 -</li>
                        <li style="height: 2em; line-height: 2em;">08:00 -</li>
                        <li style="height: 2em; line-height: 2em;">09:00 -</li>
                        <li style="height: 2em; line-height: 2em;">10:00 -</li>
                        <li style="height: 2em; line-height: 2em;">11:00 -</li>
                        <li style="height: 2em; line-height: 2em;">12:00 -</li>
                        <li style="height: 2em; line-height: 2em;">13:00 -</li>
                        <li style="height: 2em; line-height: 2em;">14:00 -</li>
                        <li style="height: 2em; line-height: 2em;">15:00 -</li>
                        <li style="height: 2em; line-height: 2em;">16:00 -</li>
                        <li style="height: 2em; line-height: 2em;">17:00 -</li>
                        <li style="height: 2em; line-height: 2em;">18:00 -</li>
                        <li style="height: 2em; line-height: 2em;">19:00 -</li>
                        <li style="height: 2em; line-height: 2em;">20:00 -</li>
                        <li style="height: 2em; line-height: 2em;">21:00 -</li>
                        <li style="height: 2em; line-height: 2em;">22:00 -</li>
                        <li style="height: 2em; line-height: 2em;">23:00 -</li>
                        <li style="height: 2em; line-height: 2em;">24:00 -</li>
                    </ul>
                    <div class="trConteudo">
                        <div class="trColQuadra" numq="0">
                            <div class="trNomeQuadra">Quadra 1<a class="trBtnFechaQuadra tr" href="">X</a></div>
                            <div class="trBgQuadra"></div>
                            <div numr="0" class="trReservado trRegistro" style="top: 19em; height: 1em;">Reserva 0</div>
                            <div numr="1" class="trReservado trRegistro" style="top: 25em; height: 6em;">Reserva 1</div>
                            <div numr="2" class="trIndisponivel trRegistro" style="top: 3em; height: 16em;"></div>
                            <div numr="3" class="trIndisponivel trRegistro" style="top: 49em; height: 2em;"></div>
                        </div>
                        <div class="trColQuadra" numq="1">
                            <div class="trNomeQuadra">Quadra 2<a class="trBtnFechaQuadra tr" href="">X</a></div>
                            <div class="trBgQuadra"></div>
                            <div numr="0" class="trReservado trRegistro" style="top: 47em; height: 2em;">Reserva 0</div>
                            <div numr="1" class="trIndisponivel trRegistro" style="top: 3em; height: 16em;"></div>
                            <div numr="2" class="trIndisponivel trRegistro" style="top: 49em; height: 2em;"></div>
                        </div>
                        <div class="trColQuadra" numq="2">
                            <div class="trNomeQuadra">Quadra 3<a class="trBtnFechaQuadra tr" href="">X</a></div>
                            <div class="trBgQuadra"></div>
                        </div>
                        <div class="trColUlt"><a class="trBtnNovaQuadra tr" href="">+</a></div>
                    </div>
                </div>
            </div>
        </div>
        
<!--        <div class="tabelaReservas">
            <div class="trContainer">
                <div class="trBg">
                    <ul>
                        <li class="trListaHorasOffset"></li>
                        <li>00:00 -</li>
                        <li>01:00 -</li>
                        <li>02:00 -</li>
                        <li>03:00 -</li>
                        <li>04:00 -</li>
                        <li>05:00 -</li>
                        <li>06:00 -</li>
                        <li>07:00 -</li>
                        <li>08:00 -</li>
                        <li>09:00 -</li>
                        <li>10:00 -</li>
                        <li>11:00 -</li>
                        <li>12:00 -</li>
                        <li>13:00 -</li>
                        <li>14:00 -</li>
                        <li>15:00 -</li>
                        <li>16:00 -</li>
                        <li>17:00 -</li>
                        <li>18:00 -</li>
                        <li>19:00 -</li>
                        <li>20:00 -</li>
                        <li>21:00 -</li>
                        <li>22:00 -</li>
                        <li>23:00 -</li>
                        <li>24:00 -</li>
                    </ul>
                    <div class="trConteudo">
                        <div class="trColQuadra">
                            <div class="trNomeQuadra">
                                Quadra 1 123456 32566
                                <a class="trBtnFechaQuadra tr" href="">X</a>
                            </div>
                            <div class="trBgQuadra"></div>
                            <div id="r4" class="trIndisponivel trRegistro"></div>
                            <div id="r1" class="trReservado trRegistro">Reserva 1</div>
                        </div>
                        <div class="trColQuadra">
                            <div class="trNomeQuadra">
                                Quadra 2
                                <a class="trBtnFechaQuadra tr" href="">X</a>
                            </div>
                            <div class="trBgQuadra"></div>
                            <div id="r2" class="trReservado trRegistro">Reserva 2</div>
                            <div id="r3" class="trReservado trRegistro">Reserva 3</div>
                        </div>
                        <div class="trColUlt">
                            <a class="trBtnNovaQuadra tr" href="">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        
    </body>
</html>
