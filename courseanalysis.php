<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="css.css" type="text/css" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include("header.php"); ?> - Course Analysis
    </title>


    <script type="text/javascript"
            src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
        var hideColum = [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18,
            19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31 ];
        //    var hideColum = [4, 5, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 21, 22, 23, 27, 28];
        var combArr = [ 6, 7, 8, 9, 14, 24, 25, 26, 29, 30, 31 ];
        var fileNum = 1;
        var programFile = 0;
        var tables = [];
        var tablesRows = [];
        var tableRows = [];
        var tableCells = [];
        var pTables = [];
        var cTables = [];
        var chartsData;
        var result = '';
        var file_header = [];
        var hr_line = document.createElement("hr");
        $(function() {
            $("#file1").on('change', function() {
                $('#upload1').click();
            });
            $("#upload1")
                .bind(
                    "click",
                    function() {
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                        if (regex.test($("#file1").val().toLowerCase())) {
                            if (typeof (FileReader) != "undefined") {
                                //alert("Success!");
                                var preader = new FileReader();
                                preader.readAsText($("#file1")[0].files[0]);
                                preader.onload = function(e) {
                                    var table = $("<table id=fileNum />");
                                    var rows = e.target.result.split("\n");
                                    var tHead = $("<thead/>");
                                    var theadtr = $("<tr />");
                                    var thcells = rows[5].split(",");
                                    for (var i = 0; i < thcells.length; i++) {
                                        var cell = $("<th />");
                                        cell.html(thcells[i]);
                                        tableCells.push(thcells[i]);
                                        theadtr.append(cell);
                                    }
                                    tHead.append(theadtr);
                                    table.append(tHead);
                                    tableRows.push(tableCells);
                                    tableCells = [];

                                    for (i = 0; i < 5; i ++){
                                        var line = rows[i].split(",");
                                        var header_line = [];
                                        for (j = 0; j < line.length; j ++){
                                            header_line.push(line[j]);
                                        }
                                        file_header.push(header_line);
                                    }
                                    for (i = 0; i < 5; i ++){
                                        rows.shift();
                                    }
                                    var tBody = $("<tbody/>");
                                    for (var i = 1; i < rows.length - 1; i++) {
                                        var row = $("<tr />");
                                        var cells = rows[i].split(",");
                                        for (var j = 0; j < cells.length; j++) {
                                            var cell = $("<td />");
                                            cell.html(cells[j]);
                                            tableCells.push(cells[j]);
                                            row.append(cell);
                                        }
                                        tBody.append(row);
                                        tableRows.push(tableCells);
                                        tableCells = [];
                                    }
                                    table.append(tBody);
                                    //                        alert("Tables length: " + tables.length);
                                    if (!containsTable(tableRows,
                                            tablesRows)) {
                                        if (tableRows[0].length == 32) {
                                            var programTable = combine(
                                                tableRows, combArr);
                                            programFile = 1;
                                            pTables.push(programTable);
                                            tablesRows.push(tableRows);
                                            tableRows = [];
                                        } else {
                                            for (i = 0; i < 5; i++){
                                                file_header.splice(file_header.length - 1, 1);
                                            }
                                            tableRows = [];
                                            //document.getElementById("file_header").innerHTML = '';
                                            alert("Program file should contain 32 columns!");
                                            return;
                                        }
                                        //                            tablesRows.push(tableRows);
                                        //                            tableRows = [];
                                        tables.push(table);
                                        //                            alert("table added!");
                                    } else {
                                        for (i = 0; i < 5; i++){
                                            file_header.splice(file_header.length - 1, 1);
                                        }
                                        tableRows = [];
                                        alert("File already exist!");
                                        return;
                                    }
                                    $("#div1").html('');
                                    var text = getFileHeader(file_header);
                                    document.getElementById("file_header").innerHTML = text;
                                    document.getElementById("file_header").append(hr_line);
//                                    drawProgramTable(pTables);
//                                    calculate(cTables);
//                                    hideALL();
//                                    uncheckAll();
                                }
                            } else {
                                alert("This browser does not support HTML5.");
                            }
                        } else {
                            alert("Please upload a valid CSV file.");
                            return;
                        }
                    });
        });
        $(function() {
            $("#file2").on('change', function() {
                $('#upload2').click();
            });
            $("#upload2")
                .bind(
                    "click",
                    function() {
                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                        if (regex.test($("#file2").val().toLowerCase())) {
                            if (typeof (FileReader) != "undefined") {
                                var creader = new FileReader();
                                creader.readAsText($("#file2")[0].files[0]);
                                creader.onload = function(e) {
                                    var table = $("<table/>");
                                    var rows = e.target.result.split("\n");
                                    var tHead = $("<thead/>");
                                    var theadtr = $("<tr />");
                                    var thcells = rows[6].split(",");
                                    for (var i = 0; i < thcells.length; i++) {
                                        var cell = $("<th />");
                                        cell.html(thcells[i]);
                                        tableCells.push(thcells[i]);
                                        theadtr.append(cell);
                                    }

                                    tHead.append(theadtr);
                                    table.append(tHead);
                                    tableRows.push(tableCells);
                                    tableCells = [];

                                    for (i = 0; i < 6; i ++){
                                        var line = rows[i].split(",");
                                        var header_line = [];
                                        for (j = 0; j < line.length; j ++){
                                            header_line.push(line[j]);
                                        }
                                        file_header.push(header_line);
                                    }
                                    for (i = 0; i < 6; i ++){
                                        rows.shift();
                                    }

                                    var tBody = $("<tbody/>");
                                    for (var i = 1; i < rows.length - 1; i++) {
                                        var row = $("<tr />");
                                        var cells = rows[i].split(",");
                                        for (var j = 0; j < cells.length; j++) {
                                            var cell = $("<td />");
                                            cell.html(cells[j]);
                                            tableCells.push(cells[j]);
                                            row.append(cell);
                                        }
                                        tBody.append(row);
                                        tableRows.push(tableCells);
                                        tableCells = [];
                                    }
                                    table.append(tBody);
                                    //                        alert("Tables length: " + tables.length);
                                    //                        if (!containsTable(tableRows, tablesRows)) {
                                    if (tableRows[0].length == 34) {
                                        if (cTables.length == 0) {
                                            cTables.push(tableRows);
                                            tablesRows.push(tableRows);
                                            tableRows = [];
                                        } else {
                                            for (i = 0; i < 6; i++){
                                                file_header.splice(file_header.length - 1, 1);
                                            }
                                            tableRows = [];
                                            alert("Maximum number of course files is one.");
                                            return;
                                        }
                                    } else {
                                        for (i = 0; i < 6; i++){
                                            file_header.splice(file_header.length - 1, 1);
                                        }
                                        tableRows = [];
                                        alert("Course file must contain 34 columns!");
                                        return;
                                    }
                                    //                            tablesRows.push(tableRows);
                                    //                            tableRows = [];
                                    tables.push(table);
                                    //                            alert("table added!");
                                    //                        } else {
                                    //                            tableRows = [];
                                    //                            alert("File already exist!");
                                    //                        }
                                    $("#div1").html('');
                                    var text = getFileHeader(file_header);
                                    document.getElementById("file_header").innerHTML = text;
                                    document.getElementById("file_header").append(hr_line);
                                    drawProgramTable(pTables);
                                    calculate(cTables);
                                    hideALL();
                                    uncheckAll();
                                }
                            } else {
                                alert("This browser does not support HTML5.");
                            }
                        } else {
                            alert("Please upload a valid CSV file.");
                        }
                    });
        });
    </script>

    <script type="text/javascript">
        function getFileHeader(array) {
            var message = "<br />";
            for (var i = 0; i < array.length; i ++){
                for (var j = 0; j < array[i].length; j ++){
                    message += (array[i][j].toString() + "&nbsp;");
                }
                message += "<br />";
            }
            return message;
        }
    </script>

    <script type="text/javascript">
        $(document)
            .ready(
                function() {
                    $("#GPA_Pie")
                        .click(
                            function() {
                                document.getElementById("c3").disabled=true;
                                document.getElementById("c6").disabled=true;
                                document.getElementById("c7").disabled=true;
                                document.getElementById("c8").disabled=true;
                                document.getElementById("c9").disabled=true;
                                document.getElementById("c14").disabled=true;
                                document.getElementById("c24").disabled=true;
                                document.getElementById("c25").disabled=true;
                                document.getElementById("c26").disabled=true;
                                document.getElementById("c29").disabled=true;
                                document.getElementById("c30").disabled=true;
                                document.getElementById("c31").disabled=true;
                                document.getElementById("selectAll").disabled=true;
                                google.load("visualization", "1", {
                                    packages : [ "corechart" ],
                                    "callback" : drawChart
                                });
                                google.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string',
                                        'GPA allocation');
                                    data.addColumn('number',
                                        'Count');
                                    data.addRows(chartsData);
                                    var options = {
                                        chartArea : {
                                            width : '100%',
                                            height : '100%'
                                        },
                                        forceIFrame : 'false',
                                        is3D : 'true',
                                        pieSliceText : 'value',
                                        //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                                        title : 'Program GPA allocation',
                                        titlePosition : 'none'
                                    };
                                    var chart = new google.visualization.PieChart(
                                        document
                                            .getElementById("piechart"));
                                    chart.draw(data, options);
                                }
                            });
                });
        $(document)
            .ready(
                function() {
                    $("#GPA_Bar")
                        .click(
                            function() {
                                document.getElementById("c3").disabled=true;
                                document.getElementById("c6").disabled=true;
                                document.getElementById("c7").disabled=true;
                                document.getElementById("c8").disabled=true;
                                document.getElementById("c9").disabled=true;
                                document.getElementById("c14").disabled=true;
                                document.getElementById("c24").disabled=true;
                                document.getElementById("c25").disabled=true;
                                document.getElementById("c26").disabled=true;
                                document.getElementById("c29").disabled=true;
                                document.getElementById("c30").disabled=true;
                                document.getElementById("c31").disabled=true;
                                document.getElementById("selectAll").disabled=true;
                                google.load("visualization", "1", {
                                    packages : [ "corechart" ],
                                    "callback" : drawChart
                                });
                                google.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string',
                                        'GPA allocation');
                                    data.addColumn('number',
                                        'Count');
                                    data.addRows(chartsData);
                                    var options = {
                                        chartArea : {
                                            width : '60%',
                                            height : '60%'
                                        },
                                        forceIFrame : 'false',
                                        //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                                        title : 'Program GPA allocation',
                                        titlePosition : 'none'
                                    };
                                    var chart = new google.visualization.ColumnChart(
                                        document
                                            .getElementById("piechart"));
                                    chart.draw(data, options);
                                }
                            });
                });
        function calGPA(array) {
            var a = 0;
            var b = 0;
            var c = 0;
            var d = 0;
            var e = 0;
            var f = 0;
            var zero = 0;
            for (var i = 0; i < array.length; i++) {
                if (parseFloat(array[i][24]) < 1.0) {
                    a++;
                }
                if (1.0 <= parseFloat(array[i][24])
                    && parseFloat(array[i][24]) < 2.0) {
                    b++;
                }
                if (2.0 <= parseFloat(array[i][24])
                    && parseFloat(array[i][24]) < 3.0) {
                    c++;
                }
                if (3.0 <= parseFloat(array[i][24])
                    && parseFloat(array[i][24]) < 4.0) {
                    d++;
                }
                if (parseFloat(array[i][24]) == 4.0) {
                    e++;
                }
                if (array[i][24] == '') {
                    f++;
                }
                if (parseFloat(array[i][24]) == 0.0) {
                    zero++;
                }
            }
            var gpa = [
                //            ['GPA=0',parseInt(zero)],
                [ 'GPA < 1', parseInt(a) ], [ '1 <= GPA < 2', parseInt(b) ],
                [ '2 <= GPA < 3', parseInt(c) ],
                [ '3 <= GPA < 4', parseInt(d) ], [ 'GPA = 4', parseInt(e) ],
                //            ['no GPA currently',parseInt(f)]
            ];
            return gpa;
        }
    </script>

    <script type="text/javascript">
        function onToggle(ckbox) {
            if (ckbox.checked) {
                show(ckbox.value);
            } else {
                hide(ckbox.value);
            }
        }
        function hide(col) {
            var thead = document.getElementsByTagName('thead');
            if (!thead.length == 0) {
                var thr = thead[0];
                thr.getElementsByTagName('th')[col].style.display = 'none';
                //thr.getElementsByTagName('th')[col].style.visibility='hidden';
            }
            var tr = document.getElementsByTagName('tr');
            if (!tr.length == 0) {
                var i;
                for (i = 1; i < tr.length; i++) {
                    tr[i].getElementsByTagName('td')[col].style.display = 'none';
                    //tr[i].getElementsByTagName('td')[col].style.visibility='hidden';
                }
            }
        }
        function show(col) {
            var thead = document.getElementsByTagName('thead');
            if (!thead.length == 0) {
                var thr = thead[0];
                thr.getElementsByTagName('th')[col].style.display = 'table-cell';
                //thr.getElementsByTagName('th')[col].style.visibility='visible';
            }
            var tr = document.getElementsByTagName('tr');
            if (!tr.length == 0) {
                var i;
                for (i = 1; i < tr.length; i++) {
                    tr[i].getElementsByTagName('td')[col].style.display = 'table-cell';
                    //tr[i].getElementsByTagName('td')[col].style.visibility='visible';
                }
            }
        }
        $(document).on(
            'click',
            'th',
            function() {
                var table = $(this).parents('table').eq(0);
                var rows = table.find('tr:gt(0)').toArray().sort(
                    comparer($(this).index()));
                this.asc = !this.asc;
                if (!this.asc) {
                    rows = rows.reverse();
                }
                table.children('tbody').empty().html(rows);
            });
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index);
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA
                    .localeCompare(valB);
            };
        }
        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text();
        }
    </script>

    <script type="text/javascript">
        function drawProgramTable(pTable) {
            if (pTable.length == 0) {
                return;
            }
            var table = document.createElement("table");
            table.setAttribute("id", "pTab");
            for (var i = 0; i < pTable.length; i++) {
                for (var j = 1; j < pTable[i].length; j++) {
                    var row = table.insertRow();
                    var stuinfo = pTable[i][j];
                    for (var k = 0; k < stuinfo.length; k++) {
                        var cell = row.insertCell();
                        cell.innerHTML = stuinfo[k];
                    }
                }
            }
            var pthead = table.createTHead();
            var ptRow = pthead.insertRow();
            for (i = 0; i < pTable[0][0].length; i++) {
                var ptcell = document.createElement("th");
                ptcell.innerHTML = pTable[0][0][i];
                ptRow.appendChild(ptcell);
            }
            document.getElementById("div1").appendChild(table);
        }
        function calculate(courseTab) {
            if (courseTab.length == 0) {
                return;
            }
            var exist = false;
            var programTab = document.getElementById("pTab");
            for (var i = 1; i < programTab.rows.length; i++) {
                for (var j = 1; j < courseTab[0].length; j++) {
                    if (programTab.rows[i].cells[0].innerHTML == courseTab[0][j][0]) {
                        exist = true;
                        //                    alert(exist);
                        break;
                    }
                }
                if (!exist) {
                    programTab.deleteRow(i);
                    i--;
                    //                alert("program table length: " + programTab.rows.length);
                } else {
                    courseTab[0].splice(j, 1);
                    //                alert("course table length: " + courseTab.length);
                }
                exist = false;
            }
            chartsData = calGPA(getChartData(programTab));
            var message = "<br />" + "The following students are not in a program: ";
            for (i = 1; i < courseTab[0].length; i++) {
                message += ("<br />" + courseTab[0][i][0]
                    + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + courseTab[0][i][1]
                    + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + courseTab[0][i][2]);
            }
            document.getElementById("text").innerHTML = message;
            result = message;
        }

        function resetTable() {
            document.getElementById("c3").disabled=false;
            document.getElementById("c6").disabled=false;
            document.getElementById("c7").disabled=false;
            document.getElementById("c8").disabled=false;
            document.getElementById("c9").disabled=false;
            document.getElementById("c14").disabled=false;
            document.getElementById("c24").disabled=false;
            document.getElementById("c25").disabled=false;
            document.getElementById("c26").disabled=false;
            document.getElementById("c29").disabled=false;
            document.getElementById("c30").disabled=false;
            document.getElementById("c31").disabled=false;
            document.getElementById("selectAll").disabled=false;
            var programTab = document.getElementById("pTab");
            document.getElementById("piechart").innerHTML = '';
            document.getElementById("div1").appendChild(programTab);
            document.getElementById("text").innerHTML = result;
        }

        function getChartData(table) {
            var charData = [];
            for (var i = 1; i < table.rows.length; i++) {
                var stuinfo = [];
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    stuinfo.push(table.rows[i].cells[j].innerHTML);
                }
                charData.push(stuinfo);
            }
            return charData;
        }
        function combine(rows, combArr) {
            var stuTab = [];
            for (var i = 0; i < rows.length; i++) {
                var stucells = rows[i];
                var stuinfo = [];
                for (var j = 0; j < stucells.length; j++) {
                    stuinfo.push(stucells[j]);
                }
                var set = true;
                for (j = 0; j < combArr.length; j++) {
                    if (combArr[j] != 24 && combArr[j] != 25 && combArr[j] != 26
                        && combArr[j] != 29 && combArr[j] != 30) {
                        for (var k = 0; k < stuTab.length; k++) {
                            if (stuinfo[0] == stuTab[k][0]) {
                                var term = stuTab[k][combArr[j]].split(",");
                                if (!contains(stuinfo[combArr[j]], term)) {
                                    term += ("," + stuinfo[combArr[j]]);
                                    stuTab[k][combArr[j]] = term;
                                }
                                set = false;
                            }
                        }
                    } else {
                        for (k = 0; k < stuTab.length; k++) {
                            if (stuinfo[0] == stuTab[k][0]
                                && stuinfo[6] > stuTab[k][6]) {
                                term = stuinfo[6];
                                stuTab[k][combArr[j]] = term;
                                set = false;
                            }
                        }
                    }
                }
                if (set) {
                    stuTab.push(stuinfo);
                }
            }
            return stuTab;
        }
        function contains(value, arr) {
            var i = arr.length;
            while (i--) {
                if (arr[i] == value) {
                    return true;
                }
            }
            return false;
        }
        function containsTable(table, tables) {
            var result = true;
            var file_not_equal = 0;
            if (tables.length == 0) {
                return false;
            }
            for (var i = 0; i < tables.length; i++) {
                result = true;
                for (var j = 0; j < table.length; j++) {
                    if (table[j].toString() == tables[i][j].toString()) {
                        continue;
                    } else {
                        result = false;
                        break;
                    }
                }
                if (!result) {
                    file_not_equal++;
                }
            }
            if (file_not_equal == tables.length) {
                return false;
            } else {
                return true;
            }
        }
    </script>

    <script type="text/javascript">
        function hideALL() {
            var thead = document.getElementsByTagName('thead');
            var thr = thead[0];
            var j;
            for (j = 0; j < 32; j++) {
                if (hideColum.indexOf(j) >= 0) {
                    thr.getElementsByTagName('th')[j].style.display = 'none';
                    //thr.getElementsByTagName('th')[j].style.visibility='hidden';
                }
            }
            var tr = document.getElementsByTagName('tr');
            var i;
            for (i = 1; i < tr.length; i++) {
                var j;
                for (j = 0; j < 32; j++) {
                    if (hideColum.indexOf(j) >= 0) {
                        tr[i].getElementsByTagName('td')[j].style.display = 'none';
                        //tr[i].getElementsByTagName('td')[j].style.visibility='hidden';
                    }
                }
            }
        }
    </script>

    <script type="text/javascript">
        function ckboxAll(ckbox) {
            var checkboxes = document.getElementsByName("xxx");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = ckbox.checked;
                if (ckbox.checked) {
                    show(checkboxes[i].value);
                } else {
                    hide(checkboxes[i].value);
                }
            }
        }
        function uncheckAll() {
            var checkboxes = document.getElementsByName("xxx");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
        }
    </script>

    <script>
        // show or hide header
        function toggle(id) {
            var state = document.getElementById(id).style.display;
            if (state == 'block') {
                document.getElementById(id).style.display = 'none';
            } else {
                document.getElementById(id).style.display = 'block';
            }
        }
    </script>

</head>
<body>

<div class="container">
    <header>
        <?php include("header.php"); ?>
        - Course Analysis
    </header>
    <section class="content">
        <div class="main">

            <div class="file_upload">
                <div class="row">
                    <div class="cell">
                        <p class="singles">
                            Upload a program file: <input type="file" id="file1" /> <input
                                    type="button" id="upload1" value="Upload"
                                    style="visibility: hidden; width: 1em" /> Upload a course file:
                            <input type="file" id="file2" /> <input type="button"
                                                                    id="upload2" value="Upload"
                                                                    style="visibility: hidden; width: 1em" /> | <a
                                    href="programanalysis.php">Go to Program Analysis</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="top_display">
                <div class="row">
                    <div class="cell40">
                        <p class="singles">Select which columns to display:</p>
                        <div class="checkboxes">
                            <div class="row">
                                <div class="cell33">
                                    <input type="checkbox" id="c3" name="xxx"
                                           onclick="onToggle(this);" value="3" />Academic Career <br />
                                    <br /> <input type="checkbox" id="c6" name="xxx"
                                                  onclick="onToggle(this);" value="6" />Term <br /> <br /> <input
                                            type="checkbox" id="c7" name="xxx" onclick="onToggle(this);"
                                            value="7" />Program Code <br /> <br /> <input type="checkbox"
                                                                                          id="c8" name="xxx" onclick="onToggle(this);" value="8" />Academic
                                    Plan <br /> <br /> <input type="checkbox" id="selectAll"
                                                              name="all" onclick="ckboxAll(this);" value="All" /><em>Select
                                        All</em>
                                </div>
                                <div class="cell33">
                                    <input type="checkbox" id="c9" name="xxx"
                                           onclick="onToggle(this);" value="9" />Admit Term <br /> <br />
                                    <input type="checkbox" id="c14" name="xxx"
                                           onclick="onToggle(this);" value="14" />Catalogue Number <br />
                                    <br /> <input type="checkbox" id="c24" name="xxx"
                                                  onclick="onToggle(this);" value="24" />Program GPA <br /> <br />
                                    <input type="checkbox" id="c25" name="xxx"
                                           onclick="onToggle(this);" value="25" />Total Units Attempted
                                </div>
                                <div class="cell33">
                                    <input type="checkbox" id="c26" name="xxx"
                                           onclick="onToggle(this);" value="26" />Total Units Passed <br />
                                    <br /> <input type="checkbox" id="c29" name="xxx"
                                                  onclick="onToggle(this);" value="29" />Total Units Credit <br />
                                    <br /> <input type="checkbox" id="c30" name="xxx"
                                                  onclick="onToggle(this);" value="30" />Cumulative Units <br />
                                    <br /> <input type="checkbox" id="c31" name="xxx"
                                                  onclick="onToggle(this);" value="31" />Student Email Address
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell30">
                        <p class="singles">Visualise data:</p>
                        <input type="button" id="GPA_Pie" value="GPA pie chart">&nbsp;&nbsp;<input
                                type="button" id="GPA_Bar" value="GPA bar chart">
                    </div>
                    <div class="cell30">
                        <p class="singles">Reset view:</p>
                        <input type="submit" value="Clear charts" id="lowbound"
                               onclick="resetTable()">
                    </div>

                </div>

            </div>

            <p></p>
            <div id="piechart"></div>
            <p></p>
            <div id="show_header">
                <p>
                    <input type="button" onclick="toggle('file_header')"
                           value="Show or hide header of the uploaded file">
                </p>
            </div>
            <div id="file_header"></div>
            <p></p>
            <div id="div1"></div>
            <div id="div2">
                <span id="text"></span>
            </div>
        </div>
    </section>
    <footer id="footer">
        <?php include("footer.php"); ?>
    </footer>
</div>
</body>
</html>