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
            
            .trContainer ul{
                position: relative;
                left: 50%; 
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
                height: 1em;
            }
            
            .trIndisponivel{
                background-color: black;
                outline: thin white dashed;
            }
            
            .trReservado{
                background-color: gray;
                outline: thin yellow dashed;
            }
            
            .trRegistro{
                position: absolute;
                width: 100%;
            }
            
            #r1{
                top: 20.5em;
                height: 3em;
            }
            #r2{
                top: 8.5em;
                height: 1.5em;
            }
            #r3{
                top: 2.5em;
                height: 1.5em;
            }
            #r4{
                top: 2.5em;
                height: 18em;
            }
            .trConteudo{
                position: relative;
                left: 50%;
                float: left;
            }
            div.trColQuadra{
                margin-left: 1em;
                position: relative;
                float: left;
                height: 76em; //1em+3*25
                max-width: 12em;
                min-width: 6em;
                //outline: black thin solid;
            }
            div.trNomeQuadra{
                width: 100%;
            }
            
            
        </style>
        
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="tabelaReservas">
            <div class="trContainer">
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
        
    </body>
</html>
