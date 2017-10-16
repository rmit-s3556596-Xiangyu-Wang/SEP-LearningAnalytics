
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="css.css" type="text/css" />
<title><?php include("header.php"); ?> - Program Analysis</title>

<script type="text/javascript"
	src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>


<script type="text/javascript">
        var hideColum = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,
            29, 30, 31];
        //    var hideColum = [4, 5, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 21, 22, 23, 27, 28];
        var combArr = [3, 6, 7, 8, 9, 14, 24, 25, 26, 29, 30, 31];
        var pieChart = [];
        var TUPChart =[];
        var description = "&nbsp;Sort columns by clicking on the desired column title:";
        $(function () {
            $("#fileUpload").on('change', function () {
                $('#upload').click();
            });
            $("#upload").bind("click", function () {
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                if (regex.test($("#fileUpload").val().toLowerCase())) {
                    if (typeof (FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.readAsText($("#fileUpload")[0].files[0]);
                        reader.onload = function (e) {
                            var table = $("<table id='tabid'/>");
                            var rows = e.target.result.split("\n");
                            var tHead = $("<thead/>");
                            var theadtr = $("<tr />");
                            var thcells = rows[0].split(",");
                            for (var i = 0; i < thcells.length; i++) {
                                var cell = $("<th />");
                                cell.html(thcells[i]);
                                theadtr.append(cell);
                            }
                            tHead.append(theadtr);
                            table.append(tHead);
                            //start
                            var stuTab = combine(rows, combArr);
                            pieChart = calGPA(stuTab);
                            TUPChart = calUnits(stuTab);
                            stuTab.unshift(rows[0].split("" +
                                ","));
                            saveStudent(stuTab);
                            stuTab.shift();
                            var tBody = $("<tbody/>");
                            for (var i = 0; i < stuTab.length; i++) {
                                var row = $("<tr />");
                                var cells = stuTab[i];
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $("<td />");
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                                tBody.append(row);
                            }
                            table.append(tBody);
                            $(".section").html('');
                            $(".section").html(description);
                            $(".section").append(table);
                            hideALL();
                            saveFile(rows);
                        }
    //                    reader.readAsText($("#fileUpload")[0].files[0]);
                    } else {
                        alert("This browser does not support HTML5.");
                    }
                } else {
                    alert("Please upload a valid CSV file.");
                }
            });
        });
    </script>

<script>
        $(document).ready(function(){
            $("#DrawChart").click(function(){
                if(document.getElementById('content').value=='Units') {
                    google.load("visualization", "1", {packages: ["corechart"], "callback": drawTUPChart});
                    google.setOnLoadCallback(drawTUPChart);
                }
                if(document.getElementById('content').value=='GPA') {
                    google.load("visualization", "1", {packages: ["corechart"], "callback": drawGPAChart});
                    google.setOnLoadCallback(drawGPAChart);
                }
                function drawTUPChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'TUP allocation');
                    data.addColumn('number', 'statistics');
                    data.addRows(TUPChart);
    //                var content = document.getElementById('content');
    //                var chartType = document.getElementById('chartType');
                    if(document.getElementById('chartType').value=='PieChart') {
                        var options = {
                            chartArea: {width:'100%',height:'100%'},
                            forceIFrame: 'false',
                            pieSliceText: 'value',
    //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                            title: 'Program GPA allocation' ,
                            titlePosition: 'none'
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                    if(document.getElementById('chartType').value=='BarChart') {
                        var options = {
                            chartArea: {width:'60%',height:'60%'},
                            forceIFrame: 'false',
    //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                            title: 'Program GPA allocation' ,
                            titlePosition: 'none'
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                }
                function drawGPAChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'GPA allocation');
                    data.addColumn('number', 'statistics');
                    data.addRows(pieChart);
    //                var content = document.getElementById('content');
    //                var chartType = document.getElementById('chartType');
                    if(document.getElementById('chartType').value=='PieChart') {
                        var options = {
                            chartArea: {width:'100%',height:'100%'},
                            forceIFrame: 'false',
                            pieSliceText: 'value',
    //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                            title: 'Program GPA allocation' ,
                            titlePosition: 'none'
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                    if(document.getElementById('chartType').value=='BarChart') {
                        var options = {
                            chartArea: {width:'60%',height:'60%'},
                            forceIFrame: 'false',
    //                    sliceVisibilityThreshold: 1/20, // Only > 5% will be shown.
                            title: 'Program GPA allocation' ,
                            titlePosition: 'none'
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
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
            for (var i = 0; i < array.length; i ++){
                if(parseFloat(array[i][24])<1.0) {
                    a++;
                }
                if(1.0<=parseFloat(array[i][24]) && parseFloat(array[i][24])<2.0) {
                    b++;
                }
                if(2.0<=parseFloat(array[i][24]) && parseFloat(array[i][24])<3.0) {
                    c++;
                }
                if(3.0<=parseFloat(array[i][24]) && parseFloat(array[i][24])<4.0) {
                    d++;
                }
                if(parseFloat(array[i][24])==4.0) {
                    e++;
                }
                if (array[i][24] == ''){
                    f++;
                }
                if (parseFloat(array[i][24]) == 0.0){
                    zero++;
                }
            }
            var gpa = [
    //            ['GPA=0',parseInt(zero)],
                ['GPA < 1',parseInt(a)],
                ['1 <= GPA < 2',parseInt(b)],
                ['2 <= GPA < 3',parseInt(c)],
                ['3 <= GPA < 4',parseInt(d)],
                ['GPA = 4',parseInt(e)],
    //            ['no GPA currently',parseInt(f)]
            ];
            return gpa;
        }
        function calUnits(array) {
            var a = 0;
            var b = 0;
            var c = 0;
            var d = 0;
            var e = 0;
            var f = 0;
            var g = 0;
            var h = 0;
            var aa= 0;
            var zero = 0;
            for (var i = 0; i < array.length; i ++){
                if(parseFloat(array[i][26])<48) {
                    a++;
                }
                if(48<=parseFloat(array[i][26]) && parseFloat(array[i][26])<96) {
                    b++;
                }
                if(96<=parseFloat(array[i][26]) && parseFloat(array[i][26])<144) {
                    c++;
                }
                if(144<=parseFloat(array[i][26]) && parseFloat(array[i][26])<192) {
                    d++;
                }
                if(192<=parseFloat(array[i][26]) && parseFloat(array[i][26])<240) {
                    e++;
                }
                if(240<=parseFloat(array[i][26]) && parseFloat(array[i][26])<288) {
                    f++;
                }
                if(288<=parseFloat(array[i][26]) && parseFloat(array[i][26])<336) {
                    g++;
                }
                if(336<=parseFloat(array[i][26]) && parseFloat(array[i][26])<384) {
                    h++;
                }
                if(parseFloat(array[i][26])==384) {
                    aa++;
                }
            }
            var gpa = [
    //            ['GPA=0',parseInt(zero)],
                ['TUP < 48',parseInt(a)],
                ['48 <= GPA < 96',parseInt(b)],
                ['96 <= GPA < 144',parseInt(c)],
                ['144 <= GPA < 192',parseInt(d)],
                ['192 <= GPA < 240',parseInt(e)],
                ['240 <= GPA < 288',parseInt(f)],
                ['288 <= GPA < 336',parseInt(g)],
                ['336 <= GPA < 384',parseInt(h)],
                ['GPA = 384',parseInt(aa)],
    //            ['no GPA currently',parseInt(f)]
            ];
            return gpa;
        }
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
        function onToggle(ckbox) {
            if (ckbox.checked) {
                show(ckbox.value);
            }
            else {
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
        $(document).on('click', 'th', function () {
            var table = $(this).parents('table').eq(0);
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            this.asc = !this.asc;
            if (!this.asc) {
                rows = rows.reverse();
            }
            table.children('tbody').empty().html(rows);
        });
        function comparer(index) {
            return function (a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index);
                return $.isNumeric(valA) && $.isNumeric(valB) ?
                    valA - valB : valA.localeCompare(valB);
            };
        }
        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text();
        }
        function combine(rows, combArr) {
            var stuTab = [];
            for (var i = 1; i < rows.length - 1; i++) {
                var stucells = rows[i].split(",");
                var stuinfo = [];
                for (var j = 0; j < stucells.length; j++) {
                    stuinfo.push(stucells[j]);
                }
                var set = true;
                for (j = 0; j < combArr.length; j++) {
                    if (combArr[j] != 24 && combArr[j] != 25 && combArr[j] != 26 && combArr[j] != 29 && combArr[j] != 30) {
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
                            if (stuinfo[0] == stuTab[k][0] && stuinfo[6] > stuTab[k][6]) {
                                var info = stuinfo[combArr[j]];
                                stuTab[k][combArr[j]] = info;
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
    </script>
<script type="text/javascript">
        function saveFile(rows) {
            if (rows != null) {
                var data = [];
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].split(",");
                    var sRow = [];
                    for (var j = 0; j < cells.length; j++) {
                        sRow.push(cells[j]);
                    }
                    data.push(sRow);
                }
                var sent = JSON.stringify(data);
                sessionStorage.setItem("tab", sent);
            }
        }
        function saveStudent(table) {
            var sentTab = JSON.stringify(table);
            sessionStorage.setItem("stuTab", sentTab);
        }
    </script>
<script type="text/javascript">
        var refresh = true;
        function createStudentTab() {
            var data = sessionStorage.getItem("stuTab");
            var read = JSON.parse(data);
            if (refresh) {
                document.getElementById("div1").innerHTML = '';
            }
            var userInput = document.getElementById("student_id").value;
            if (read != null) {
                if (!userInput.length == 0) {
                    var stuTab = [];
                    stuTab.push(read[0]);
                    for (var i = 1; i < read.length; i++) {
                        var stuRow = read[i];
                        if (stuRow[0] == userInput) {
                            stuTab.push(stuRow);
                        }
                    }
                    if (stuTab.length == 1) {
                        alert("No such student!");
                        refresh = false;
                        document.getElementById("student_id").value = '';
                        stuTab.deleteRow();
                        location.reload();
                    }
                    var table = document.createElement("table");
                    table.setAttribute("id", "stuTab");
                    for (i = 1; i < stuTab.length; i++) {
                        var row = table.insertRow();
                        var iRow = stuTab[i];
                        for (var j = 0; j < iRow.length; j++) {
                            var cell = row.insertCell();
                            cell.innerHTML = iRow[j];
                        }
                    }
                    var thead = table.createTHead();
                    var tRow = thead.insertRow();
                    for (i = 0; i < stuTab[0].length; i++) {
                        var tCell = document.createElement("th");
                        tCell.innerHTML = stuTab[0][i];
                        tRow.appendChild(tCell);
                    }
                    var sent = JSON.stringify(stuTab);
                    sessionStorage.setItem("studentCKboxTab", sent);
                    document.getElementById("div1").appendChild(table);
                    document.getElementById("student_id").value = '';
                    hideColumns("student");
                    uncheckAll();
                    refresh = true;
                } else {
                    alert("No message input!");
                    refresh = false;
                }
            }
        }
    </script>

<script type="text/javascript">
        function createCourseTab() {
            var data = sessionStorage.getItem("tab");
            var read = JSON.parse(data);
            document.getElementById("div1").innerHTML = '';
            var userInput = document.getElementById("course_id").value;
            if (read != null) {
                if (!userInput.length == 0) {
                    var stuTab = [];
                    stuTab.push(read[0]);
                    for (var i = 1; i < read.length; i++) {
                        var stuRow = read[i];
                        if (stuRow[14] == userInput) {
                            stuTab.push(stuRow);
                        }
                    }
                    if (stuTab.length == 1) {
                        alert("Course ID not found!");
                        document.getElementById("course_id").value = '';
                        stuTab.deleteRow();
                        location.reload();
                    }
                    var tab = combines(stuTab, [12, 13, 14]);
                    var table = document.createElement("table");
                    table.setAttribute("id", "courseTable");
                    for (i = 1; i < tab.length; i++) {
                        var row = table.insertRow();
                        var iRow = tab[i];
                        for (var j = 0; j < iRow.length; j++) {
                            var cell = row.insertCell();
                            cell.innerHTML = iRow[j];
                        }
                    }
                    var thead = table.createTHead();
                    var tRow = thead.insertRow();
                    for (i = 0; i < tab[0].length; i++) {
                        var tCell = document.createElement("th");
                        tCell.innerHTML = tab[0][i];
                        tRow.appendChild(tCell);
                    }
                    var sent = JSON.stringify(tab);
                    sessionStorage.setItem("courseCKboxTab", sent);
                    document.getElementById("div1").append(description);
                    document.getElementById("div1").appendChild(table);
                    document.getElementById("course_id").value = '';
                    hideColumns("course");
                    uncheckAll();
                } else {
                    alert("Please enter some text!");
                }
            }
        }
        function combines(rows, combArr) {
            var stuTab = [];
            for (var i = 0; i < rows.length; i++) {
                var stucells = rows[i];
                var stuinfo = [];
                for (var j = 0; j < stucells.length; j++) {
                    stuinfo.push(stucells[j]);
                }
                var set = true;
                for (j = 0; j < combArr.length; j++) {
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
    </script>
<script type="text/javascript">
        function hideColumns(value) {
            var table;
            if (value == "course") {
                table = document.getElementById("courseTable");
            } else if (value == "student") {
                table = document.getElementById("stuTab");
            } else if (value == "term") {
                table = document.getElementById("termTable");
            } else if (value == "total_unit_pass") {
                table = document.getElementById("unitTable");
            } else if (value == "term_course") {
                table = document.getElementById("CnTable");
            }else if (value == "resetTable"){
                table = document.getElementById("resetTable");
            }
            for (var i = 0; i < table.rows.length; i++) {
                for (var j = 0; j < 32; j++) {
                    if (hideColum.indexOf(j) >= 0) {
                        table.rows[i].cells[j].style.display = 'none';
                    }
                }
            }
        }
    </script>
<script type="text/javascript">
        function createTermTab() {
            var read = sessionStorage.getItem("stuTab");
            var termTab = JSON.parse(read);
            document.getElementById("div1").innerHTML = '';
            var termNum = document.getElementById('num_of_term').value;
            if (read != null) {
                if (!termNum.length == 0) {
                    var table = document.createElement("table");
                    table.setAttribute("id", "termTable");
                    for (var i = 1; i < termTab.length; i++) {
                        var stuinfo = termTab[i];
                        var term = stuinfo[6].split(',');
                        if (term.length == termNum) {
                            var row = table.insertRow();
                            for (var j = 0; j < stuinfo.length; j++) {
                                var cell = row.insertCell();
                                cell.innerHTML = stuinfo[j];
                            }
                        }
                    }
                    var thead = table.createTHead();
                    var tRow = thead.insertRow();
                    for (i = 0; i < termTab[0].length; i++) {
                        var tCell = document.createElement("th");
                        tCell.innerHTML = termTab[0][i];
                        tRow.appendChild(tCell);
                    }
                    document.getElementById("div1").append(description);
                    document.getElementById("div1").appendChild(table);
                    document.getElementById("num_of_term").value = '';
                    hideColumns("term");
                    uncheckAll();
                }
            }
        }
    </script>
<script type="text/javascript">
        function createUnitPassTab() {
            var read = sessionStorage.getItem("stuTab");
            var unitTab = JSON.parse(read);
            document.getElementById("div1").innerHTML = '';
            var unit = document.getElementById("total_unit_pass").value;
            if (read != null) {
                if (!unit.length == 0) {
                    var table = document.createElement("table");
                    table.setAttribute("id", "unitTable");
                    for (var i = 1; i < unitTab.length; i++) {
                        var stuinfo = unitTab[i];
                        var unitPass = stuinfo[26];
                        if (parseInt(unit) <= parseInt(unitPass)) {
                            var row = table.insertRow();
                            for (var j = 0; j < stuinfo.length; j++) {
                                var cell = row.insertCell();
                                cell.innerHTML = stuinfo[j];
                            }
                        }
                    }
                    var thead = table.createTHead();
                    var tRow = thead.insertRow();
                    for (i = 0; i < unitTab[0].length; i++) {
                        var tCell = document.createElement("th");
                        tCell.innerHTML = unitTab[0][i];
                        tRow.appendChild(tCell);
                    }
                    document.getElementById("div1").append(description);
                    document.getElementById("div1").appendChild(table);
                    document.getElementById("total_unit_pass").value = '';
                    hideColumns("total_unit_pass");
                    uncheckAll();
                }
            }
        }
    </script>
<script type="text/javascript">
        function createTermCourseTab() {
            var read1 = sessionStorage.getItem("tab");
            var read2 = sessionStorage.getItem("stuTab");
            var rowData = JSON.parse(read1);
            var CnTable = JSON.parse(read2);
            document.getElementById("div1").innerHTML = '';
            var term = document.getElementById("term_number").value;
            var catalogNum = document.getElementById("catalog_number").value;
            var list = [];
            for (var i = 1; i < rowData.length; i++) {
                if (rowData[i][6] == term && rowData[i][14] == catalogNum) {
                    var stuID = rowData[i][0];
                    list.push(stuID);
                }
            }
            var tabList = [];
            for (i = 0; i < list.length; i++) {
                for (var j = 1; j < CnTable.length; j++) {
                    if (list[i] == CnTable[j][0]) {
                        tabList.push(CnTable[j]);
                    }
                }
            }
            var table = document.createElement("table");
            table.setAttribute("id", "CnTable");
            for (var i = 0; i < tabList.length; i++) {
                var stuinfo = tabList[i];
                var row = table.insertRow();
                for (var j = 0; j < stuinfo.length; j++) {
                    var cell = row.insertCell();
                    cell.innerHTML = stuinfo[j];
                }
            }
            var thead = table.createTHead();
            var tRow = thead.insertRow();
            for (i = 0; i < CnTable[0].length; i++) {
                var tCell = document.createElement("th");
                tCell.innerHTML = CnTable[0][i];
                tRow.appendChild(tCell);
            }
            document.getElementById("div1").append(description);
            document.getElementById("div1").appendChild(table);
            document.getElementById("term_number").value = '';
            document.getElementById("catalog_number").value = '';
            hideColumns("term_course");
            uncheckAll();
        }
    </script>
<script type="text/javascript">
        function resetTable() {
            var read = sessionStorage.getItem("stuTab");
            var unitTab = JSON.parse(read);
            document.getElementById("div1").innerHTML = '';
            document.getElementById("piechart").innerHTML = '';
            if (read != null) {
                var table = document.createElement("table");
                table.setAttribute("id", "resetTable");
                for (var i = 1; i < unitTab.length; i++) {
                    var stuinfo = unitTab[i];
                    var row = table.insertRow();
                    for (var j = 0; j < stuinfo.length; j++) {
                        var cell = row.insertCell();
                        cell.innerHTML = stuinfo[j];
                    }
                }
                var thead = table.createTHead();
                var tRow = thead.insertRow();
                for (i = 0; i < unitTab[0].length; i++) {
                    var tCell = document.createElement("th");
                    tCell.innerHTML = unitTab[0][i];
                    tRow.appendChild(tCell);
                }
                document.getElementById("div1").append(description);
                document.getElementById("div1").appendChild(table);
                hideColumns("resetTable");
                uncheckAll();
            }
        }
    </script>
<script type="text/javascript">
        function ckboxAll(ckbox) {
            //var checkboxes = document.getElementsByName("xxx");
            for (var i = 0; i < combArr.length; i ++){
                var checkbox = document.getElementById("c" + combArr[i]);
                checkbox.checked = ckbox.checked;
                if (ckbox.checked){
                    show(checkbox.value);
                }else {
                    hide(checkbox.value);
                }
            }
        }
        function uncheckAll() {
            var checkboxes = document.getElementsByName("xxx");
            for (var i = 0; i < checkboxes.length; i ++){
                checkboxes[i].checked = false;
            }
        }
    </script>

</head>

<body>
	<div class="container">
		<header><?php include("header.php"); ?> - Program Analysis</header>
		<section class="content">
			<div class="main">

				<div class="file_upload">
					<div class="row">
						<div class="cell">
							<p class="singles">
								Start by uploading a file: <input type="file" id="fileUpload" />
								<input type="button" class="upload" id="upload" value="Upload"
									style="visibility: hidden" /> | <a href="courseanalysis.php">Go
									to Course Analysis</a>
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
											name="xxx" onclick="ckboxAll(this);" value="All" /><em>Select
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
							<p class="singles">Apply filters:</p>
							<p class="smalls">Students who took particular course:</p>
							<input type="text" name="courseID" id="course_id"
								placeholder="Course number (e.g., 1114)">&nbsp; <input
								type="submit" value="Filter" onclick="createCourseTab()">
							<p></p>
							<p class="smalls">Students who studied over a particular number
								of terms greater or equal to:</p>
							<input type="text" name="num_of_term" id="num_of_term"
								placeholder="Number of terms">&nbsp; <input type="submit"
								value="Filter" onclick="createTermTab()">
							<p></p>
							<p class="smalls">Students who passed a number of units greater
								or equal to:</p>
							<input type="text" name="num_of_term" id="total_unit_pass"
								placeholder="Number of total units passed">&nbsp; <input
								type="submit" value="Filter" onclick="createUnitPassTab()">
							<p></p>
							<p class="smalls">Students who took a particular course during a
								particular term:</p>
							<input type="text" name="num_of_term" id="catalog_number"
								placeholder="Course catalog number">&nbsp;<input type="text"
								name="num_of_term" id="term_number"
								placeholder="Term number (e.g., 1150):">&nbsp; <input
								type="submit" value="Filter" onclick="createTermCourseTab()">
							<p></p>
							<p></p>
							<div class="centerbutton">
								<input type="submit" value="Reset filters" id="lowbound"
									onclick="resetTable()">
							</div>
						</div>

						<div class="cell30">
							<p class="singles">Visualise data:</p>
							<div class="graph">
								<select id="content">
									<optgroup label="Choose what to display">
										<option value="Units">Total Units Passed</option>
										<option value="GPA">GPA</option>
									</optgroup>
								</select>
								<p></p>
								<select id="chartType">
									<optgroup label="Choose chart type">
										<option value="PieChart">Pie chart</option>
										<option value="BarChart">Bar chart</option>
									</optgroup>
								</select>
								<p></p>
								<input type="button" id="DrawChart" value="Draw chart">
							</div>

						</div>
					</div>
				</div>

				<p></p>
				<div id="div1" class="section"></div>
				<p></p>
				<div id="piechart"></div>
			</div>
		</section>
		<footer> <?php include("footer.php"); ?></footer>
	</div>
</body>
</html>