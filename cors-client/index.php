<?php
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "Cors Demo";
include (ABS_PATH . "/appsec/include/header.php");
?>
<head>
	<title>Cors Demo</title>
	<!--link href="styles/theme.css" rel="stylesheet"-->
	<script src="lib/angular.min.js"></script>
	<script src="lib/angular-resource.min.js"></script>
	<script src="js/corsCtrl.js"></script>
	<script src="js/urlCtrl.js"></script>
</head>
<body>
	<div id ="main" ng-app="CorsTest">
		<div id="divContainer" ng-controller="corsCtrl" align="center">
			<form>
				<!--p>
				<label>Choose URL : </label>
				<select id = "myList" ng-controller="urlCtrl">
				<option ng-repeat="url in urls">{{url.urlId}}</option>
				</select>
				</p-->
				<table width="80%" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
					<tr>
						<td align="center">
						<button class="button" ng-click="isAllowed()">
							CORS Enabled
						</button></td>
						<td align="center">
						<button class="button" ng-click="isNotAllowed()">
							CORS Disabled
						</button></td>
					</tr>
					<tr><td></td><td></td></tr>

				</table>

				<table width="80%" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">

					<tr>
						<td>Response: </td>
						<td><span class="data">{{corsData}}</span></td>
					</tr>
					<tr>
						<td>URL: </td>
						<td><span class="data">{{corsURL}}</span></td>
					</tr>
					<tr>
						<td>Status: </td>
						<td><span class="data">{{corsStatus}}</span></td>
					</tr>
					<!-- button ng-click="useResource()">$resource request</button -->
				</table>
			</form>

		</div>
	</div>
	<?php include (ABS_PATH . "/appsec/include/footer.php"); ?>
