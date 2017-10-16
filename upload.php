<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="css.css" type="text/css" />
<script type="text/javascript">
	var hideColum = [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18,
			19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31 ];
	$(function() {
		$("#upload").bind("click", function() {
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
			if (regex.test($("#fileUpload").val().toLowerCase())) {
				if (typeof (FileReader) != "undefined") {
					/* alert("File uploaded successfully! Click OK to continue."); */
					var reader = new FileReader();
					reader.onload = function(e) {
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

						var tBody = $("<tbody/>");
						for (var i = 1; i < rows.length - 1; i++) {
							var row = $("<tr />");
							var cells = rows[i].split(",");
							for (var j = 0; j < cells.length; j++) {
								var cell = $("<td />");
								cell.html(cells[j]);
								row.append(cell);
							}
							tBody.append(row);
						}
						table.append(tBody);
						$(".section").html('');
						$(".section").append(table);
						hideALL();
					}
					reader.readAsText($("#fileUpload")[0].files[0]);

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
		// check if checkbox is checked
		if (ckbox.checked) {
			show(ckbox.value);
		} else {
			hide(ckbox.value);
		}
	}

	function hide(col) {
		var thead = document.getElementsByTagName('thead');
		var thr = thead[0];
		thr.getElementsByTagName('th')[col].style.display = 'none';
		//thr.getElementsByTagName('th')[col].style.visibility='hidden';

		var tr = document.getElementsByTagName('tr');
		var i;
		for (i = 1; i < tr.length; i++) {
			tr[i].getElementsByTagName('td')[col].style.display = 'none';
			//tr[i].getElementsByTagName('td')[col].style.visibility='hidden';

		}
	}

	function show(col) {
		var thead = document.getElementsByTagName('thead');
		var thr = thead[0];
		thr.getElementsByTagName('th')[col].style.display = 'table-cell';
		//thr.getElementsByTagName('th')[col].style.visibility='visible';

		var tr = document.getElementsByTagName('tr')
		var i;
		for (i = 1; i < tr.length; i++) {
			tr[i].getElementsByTagName('td')[col].style.display = 'table-cell';
			//tr[i].getElementsByTagName('td')[col].style.visibility='visible';
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
</head>
<body>
	<header> RMIT - Learning Analytics </header>

	<main>

	<div class="upload_facility">
		<input type="file" id="fileUpload" /> <input type="button"
			class="upload" id="upload" value="Upload" />
	</div>

	<table width="100%" class="checkboxes">

		<tr>
			<td><input type="checkbox" id="c3" name="xxx"
				onclick="onToggle(this);" value="3" />Academic Career</td>
			<td><input type="checkbox" id="c13" name="xxx"
				onclick="onToggle(this);" value="13" />Subject Id</td>
			<td><input type="checkbox" id="c23" name="xxx"
				onclick="onToggle(this);" value="23" />Term GPA</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c4" name="xxx"
				onclick="onToggle(this);" value="4" />Acad Level (by Term)</td>
			<td><input type="checkbox" id="c14" name="xxx"
				onclick="onToggle(this);" value="14" />Catalogue Number</td>
			<td><input type="checkbox" id="c24" name="xxx"
				onclick="onToggle(this);" value="24" />Program GPA</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c5" name="xxx"
				onclick="onToggle(this);" value="5" />Program Campus</td>
			<td><input type="checkbox" id="c15" name="xxx"
				onclick="onToggle(this);" value="15" />Class Number</td>
			<td><input type="checkbox" id="c25" name="xxx"
				onclick="onToggle(this);" value="25" />Total Units Attempt</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c6" name="xxx"
				onclick="onToggle(this);" value="6" />Term</td>
			<td><input type="checkbox" id="c16" name="xxx"
				onclick="onToggle(this);" value="16" />Session Code</td>
			<td><input type="checkbox" id="c26" name="xxx"
				onclick="onToggle(this);" value="26" />Total Units Passed</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c7" name="xxx"
				onclick="onToggle(this);" value="7" />Program Code</td>
			<td><input type="checkbox" id="c17" name="xxx"
				onclick="onToggle(this);" value="17" />Section Code</td>
			<td><input type="checkbox" id="c27" name="xxx"
				onclick="onToggle(this);" value="27" />Funding Source</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c8" name="xxx"
				onclick="onToggle(this);" value="8" />Academic Plan</td>
			<td><input type="checkbox" id="c18" name="xxx"
				onclick="onToggle(this);" value="18" />Class Campus</td>
			<td><input type="checkbox" id="c28" name="xxx"
				onclick="onToggle(this);" value="28" />ACADPR Comments</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c9" name="xxx"
				onclick="onToggle(this);" value="9" />Admit Term</td>
			<td><input type="checkbox" id="c19" name="xxx"
				onclick="onToggle(this);" value="19" />Grade Entered</td>
			<td><input type="checkbox" id="c29" name="xxx"
				onclick="onToggle(this);" value="29" />Total Units Credit</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c10" name="xxx"
				onclick="onToggle(this);" value="10" />Course Owner</td>
			<td><input type="checkbox" id="c20" name="xxx"
				onclick="onToggle(this);" value="20" />Grade Official</td>
			<td><input type="checkbox" id="c30" name="xxx"
				onclick="onToggle(this);" value="30" />Cumulative Units</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c11" name="xxx"
				onclick="onToggle(this);" value="11" />Course Id</td>
			<td><input type="checkbox" id="c21" name="xxx"
				onclick="onToggle(this);" value="21" />Grade Roster Input</td>
			<td><input type="checkbox" id="c31" name="xxx"
				onclick="onToggle(this);" value="31" />Student Email Address</td>
		</tr>

		<tr>
			<td><input type="checkbox" id="c12" name="xxx"
				onclick="onToggle(this);" value="12" />Course Description</td>
			<td><input type="checkbox" id="c22" name="xxx"
				onclick="onToggle(this);" value="22" />Grade in Roster Status</td>
		</tr>

	</table>

	<div class="section"></div>

	</main>

</body>
</html>