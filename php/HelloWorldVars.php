<!DOCTYPE html>
<html>
    <head>
        <title>Hello World Vars</title>
    </head>
    <body>
        <h1>Hello
            <?php
                $name = "Matt";
                echo("Hello, $name");
            ?>
        </h1>
		<?php
			$state[0] = "Testing";
			$state[1] = "Arrays";
			class Appliance {
				private $_power;
				function set_Power($status) {
					$this -> $_power = $status;
				}
			}
		?> <!--End php -->
		<!--creates a php class, makes object, then sets its $_power attribute to "on" -->
		<h3>Testing Appliance Class</h3>
		<?php
			$blender = new Appliance;
			$blender -> set_Power("on");
			echo($blender -> $_power);
		?>
		<br><br>
		<?php
			$var1 = "Hello";
			$var2 = $var1;
			echo("testing again");
		?>
		<h2>Testing Scope</h2>
		<?php
			$x = 4;
			$GLOBALS["newX"] = 4;
			function checkX(){
				$x = 2;
				echo($x);
				echo(" <-- Due to scope 'x' remaind the value before the function when the real value is: ");
				echo($GLOBALS["newX"]);
			}
			checkX();
		?>
		<h3><br>Constants can be defined with 'define'</h3>
		<?php
			define("PI", 3.141592);
			echo("This value is a defined variable, and 'define' is mostly used for mathmatical use.");
			echo("\n");
			echo(PI);
		?>
		<!--using global to name a var will allow access to it from everywhere -->
		<!--$GLOBALS[] is a php maintained array for global variables -->
    </body>
</html>
