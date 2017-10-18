<!DOCTYPE html>
<html>
<head>
<title><?php include("header.php"); ?> - Help Page</title>
<link rel="stylesheet" href="css.css" type="text/css" />
</head>
<body>
	<div class="container">
		<header><?php include("header.php"); ?> - Help Page</header>

		<section class="content">
			<div class="main">

				<div class="indent_text">
					<h2>Course Analysis</h2>
					<p></p>

					<h2>Program Analysis</h2>
					<p>
						The user should start the session by clicking the <span
							class="monospace">Browse</span> button and uploading a <span
							class="monospace">CSV</span> type file.
					</p>
					<p>
						The page will automatically upload the contents of the file
						provided it is in the right format. The user can choose which
						columns to display in the table by ticking one or more checkboxes
						under the <span class="monospace">Select which columns to display</span>
						heading, or show all columns by ticking the <span
							class="monospace">Select All</span> checkbox.
					</p>
					<p>
						Filters can be applied to the displayed table by entering the
						appropriate information under the <span class="monospace">Apply
							filters</span> heading. Additional instructions are shown above
						each textbox to inform the user of the expected input. To undo the
						applied filters, user can click the <span class="monospace">Reset
							filters</span> button.
					</p>
					<p>
						Total Units Passed or GPA information can be displayed in a bar
						chart or a pie chart. The user can select which of the two options
						they wish to visualise, and select the type of chart to be
						displayed from the dropdown menus under the <span
							class="monospace">Visualise data</span> heading, and by clicking
						the <span class="monospace">Draw chart</span> button.
					</p>
					<p>
						Information from the file header can be toggled by the user by
						clicking on the <span class="monospace">Toggle header</span>
						button, under the table. This information can be user to verify
						the time, date, and user who generated the data file.
					</p>


					<div class="indent_text">
						<h3>Known bugs and issues</h3>
						<p>
							There is one known bug in the system that concerns the
							visualisation of data. When the user clicks the <span
								class="monospace">Draw chart</span> button the first time, an
							error message appears in the place of a chart on non-Chrome
							browsers. This bug has been identified by Google engineers, and a
							patch is being worked on. To get around this issue, the user can
							click the same button again, or simply use the Chrome browser.
						</p>
					</div>

				</div>
				<p>&nbsp;</p>
				<hr>
				<p class="center_bold">
					Click <a href="javascript:history.back()">here</a> to go back.
				</p>
				<hr>
			</div>
		</section>
		<footer>
		<?php include("footer.php"); ?>
		</footer>
	</div>
</body>
</html>