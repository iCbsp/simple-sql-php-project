<!DOCTYPE html>
<html lang="es">
	<?php include_once("inc/head.php");?>
	<body>

		<div class="header">
			<h1><a href="index.php">Clientes</a></h1>
			<p>Nombre, Apellidos...</p>
		</div>

		<table>
			<?php
			$mysqli = @new mysqli( 
				'localhost',   // El servidor 
				'root',    // El usuario 
				'',          // La contraseña 
				'bd_pruebasSQL'); // La base de datos 

			if($mysqli->connect_errno) { 
				echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error; 
				echo '</p>'; 
				exit; 
			}

			 // Ejecuta una sentencia SQL 
			 $sentencia_clientes = 'SELECT * FROM Cliente'; 
			 if(!($clientes = $mysqli->query($sentencia_clientes))) { 
			   echo "<p>Error al ejecutar la sentencia <b>$sentencia_clientes</b>: " . $mysqli->error . '</p>';
			   exit; 
			 } 
			 
			echo "<tr>";
				echo "<th></th>";
				echo "<th> Nombre </th>";
				echo "<th> Apellidos </th>";
				echo "<th> Número </th>";
				echo "<th> Provincia </th>";
			echo "</tr>";	
			$contador = 0;
			while($cliente = $clientes->fetch_object()) {
				$contador++;
				echo "<tr>";
					echo "<th>" . $contador . "</th>";
					echo "<td>" . $cliente->Nombre . "</td>";
					echo "<td>" . $cliente->Apellidos . "</td>";
					echo "<td>" . $cliente->Número . "</td>";

					$sentencia_provincia_ID = 'SELECT Nombre FROM Provincia WHERE ID = ' . $cliente->Provincia;
					if(!($provincias_ID = $mysqli->query($sentencia_provincia_ID))) {
					  echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error . '</p>';
					  exit;
					}
					while($provincia_ID = $provincias_ID->fetch_object()) {
						echo "<td><a href='Provincia.php?ID=" . $cliente->Provincia . "'>" . $provincia_ID->Nombre . "</a></td>";
					}
					//echo "<td> " . $fila->Provincia . " </td>";
				echo "</tr>";
			}

			 // Libera la memoria ocupada por el resultado 
			 $clientes->close();
			 $provincias_ID->close();
			 // Cierra la conexión 
			 $mysqli->close();
			?>
		</table>
	</body>
</html>