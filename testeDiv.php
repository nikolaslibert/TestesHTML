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
            div.trNomeQuadra{
                outline: black thin solid;
                background-color: #555;
                padding: 0.75em;
                font-size: 1em;
                color: #ffffff;
                margin-left: auto;
                margin-right: auto;
            }
            
            
        </style>
        
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="tabelaReservas">
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
                            <div class="trNomeQuadra">Quadra 1</div>
                            <div id="r4" class="trIndisponivel trRegistro"></div>
                            <div id="r1" class="trReservado trRegistro">Reserva 1</div>
                        </div>
                        <div class="trColQuadra">
                            <div class="trNomeQuadra">Quadra 2</div>
                            <div id="r2" class="trReservado trRegistro">Reserva 2</div>
                            <div id="r3" class="trReservado trRegistro">Reserva 3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
