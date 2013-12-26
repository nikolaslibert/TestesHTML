<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            td{ border: 1px solid #666; cursor:pointer}
            div { padding:0 8px; }
            .selected{ background: green}
        </style>
        
        <script src="include/jquery-1.10.2.js"></script>
        
        <script>
        $(document).ready(function(){
            var $table = $('#table').html(makeTable());
            
            
            /* when range selected,  next click will only clear range and 
            won't set a new "selected" cell if true*/
            var useClickToClearRangeBeforeStartNewRange = true;

            $table.click(function(e) {

                var selectedCells = getCellArr();

                var $cell = $(e.target).closest('td');

                if (selectedCells && selectedCells.length === 2) {
                    clearAllSelections();       
                    if (useClickToClearRangeBeforeStartNewRange) {
                        return;
                    }
                     selectedCells = null;
                }

                var $row = $cell.parent();

                var cellIdx = $cell.addClass('selected').index(),
                    rowIdx = $row.index(),
                    currSelect = [rowIdx, cellIdx];

                if (!selectedCells) {
                    setCellArr([currSelect]);

                } else {
                    selectedCells.push(currSelect);
                    setCellArr(selectedCells); /* sort row and cell indices */
                    var actRows = mapElIdx(selectedCells, 'tr'),
                        actCells = mapElIdx(selectedCells, 'td');

                    $table.find('tr').slice(actRows[0], actRows[1] + 1).each(function() {
                        $(this).addClass('active').find('td').slice(actCells[0], actCells[1] + 1).addClass('selected');
                    });

                }

            });

            function getCellArr() {
                return $table.data('selectedx') || false;
                //console.log('getCellArr', $table.data('selected'))
            }

            function setCellArr(arr) {
                $table.data('selectedx', arr);
                //console.log('setCellArr', $table.data('selected'))
            }

            function clearAllSelections() {
                //console.info('clear all')
                $('.active').removeClass('active').find('.selected').removeClass('selected');
                $table.removeData();
            }

            function mapElIdx(idxArray, elType) {
                var elPos = (elType === 'tr') ? 0 : 1;
                return $.map(idxArray, function(arr) {
                    return arr[elPos];
                }).sort(sortNum);
            }

            function sortNum(a, b) {
                return a - b;
            }

            /* function to create table for demo only */

            function makeTable() {
                var html = [];
                for (i = 0; i < 20; i++) {
                    html.push('<tr><td>');
                    var cells = [];
                    for (j = 0; j < 20; j++) {
                        cells.push('<div>&nbsp;</div>');
                    }
                    html.push(cells.join('</td><td>') + '</td></tr>');
                }
                return html.join('');
            }
        });
        </script>
        
    </head>
    <body>
        <div id="teste"></div>
        <table id="table"></table>
    </body>
</html>

