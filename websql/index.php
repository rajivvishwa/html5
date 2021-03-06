<?php
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "WebSQL Injection";
include (ABS_PATH . "/appsec/include/header.php");
?>
<div id="main">
	<div id="divContainer" align=center>
		<input type="text" name="userVal" size="20" id="userVal"
		onkeydown="if (event.keyCode == 13) document.getElementById('sub').click()" autocomplete="off"/>
		<input type="checkbox" id="secure_flag" value="true" class="css-cb"/>
		<label for="secure_flag" name="secure_flag" class="css-lbl">Secure? &nbsp; </label>

		<input type="submit" id="sub" onclick="dbProcess()" class="button"/>

	</div>
	<div id="divContainer" align=center>
		<script type="text/javascript">
			function dbProcess() {

				var db = openDatabase('testdb', '1.0', 'Test web database', 2000);
				var userValue = document.getElementById("userVal").value;
				var secureFlg = document.getElementById("secure_flag").checked;
				var id = 2;
				var secureQuery = "'INSERT INTO testTbl (id, text) VALUES (?, ?)', [id, \"" + userValue + "\"]";
				var insecureQuery = "'INSERT INTO testTbl (id, text) VALUES (2, \"" + userValue + "\")'";

				//var userValue = "webSQL2";
				db.transaction(function(tx) {
					tx.executeSql('DROP TABLE IF EXISTS testTbl');
					tx.executeSql('CREATE TABLE IF NOT EXISTS testTbl (id unique, text)');

					tx.executeSql('INSERT INTO testTbl (id, text) VALUES (1, "Hardcoded Val")');
					if (secureFlg) {
						document.querySelector('#query').innerHTML = secureQuery;
						tx.executeSql('INSERT INTO testTbl (id, text) VALUES (?, ?)', [id, userValue], successFn, errorFn);
						document.querySelector('#sqli').style.visibility = 'hidden';
					} else {
						document.querySelector('#query').innerHTML = insecureQuery;

						//")'drop table testTbl
						tx.executeSql('INSERT INTO testTbl (id, text) VALUES (2, "' + userValue + '")', null, successFn, errorFn);

					}
					document.querySelector('#dbVal').innerHTML = "";

					tx.executeSql('SELECT * FROM testTbl', [], function(tx, results) {
						var len = results.rows.length, i;
						for ( i = 0; i < len; i++) {
							//alert(results.rows.item(i).text);
							document.querySelector('#dbVal').innerHTML += (i + 1) + ") " + results.rows.item(i).text + "<br>";

						}

					});

				});

				function successFn(tx, rs) {
					console.log('All is well');
				}

				errorFn = function(tx, e) {
					document.querySelector('#sqli').style.visibility = 'visible';
					console.error('Error: ' + e.message);
					document.querySelector('#sqli').innerHTML = '<br>SqlError ' + e.code + " :" + e.message;
				}
			}

		</script>

		<br/>
		<h3>Query</h3>
		<br/>
		<div name="query" id="query" style="font-family:monospace"></div>
		<div name="sqli" id="sqli" style="visibility: hidden;font-family:monospace;color: red;"></div>
		<br/>
		<br/>
		<h3>DB Contents</h3>
		<br/>
		<div id="dbVal" name="dbVal"></div>
		<br/>
	</div>
	<?php
	include (ABS_PATH . "/appsec/include/footer.php");
	?>

