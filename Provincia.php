<!DOCTYPE html>
<html lang="es">
	<?php include_once("inc/head.php");?>

	<body>
	<div class="header">

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
		 $provincias_sentencia = 'SELECT * FROM Provincia WHERE ID = ' . $_GET["ID"]; 
		 if(!($provincias = $mysqli->query($provincias_sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . '</p>';
		   exit; 
		 } 
		 echo "<h1><a href='index.php'>";
		 $coordenadas = NULL;
		 while($provincia = $provincias->fetch_object()) {
		 	echo $provincia->Nombre;
		 	$coordenadas = [$provincia->Longitud, $provincia->Latitud];
		 }
		 echo "</a></h1>";

		?>

		<p>Texto</p>

	</div>
	<div class="mapContainer">	
		<h2>Mapa</h2>
		<div id="map" class="map"></div>
	</div>
    <script type="text/javascript">
      var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          //center: ol.proj.fromLonLat([37.41, 8.82]),
          center: ol.proj.fromLonLat([<?php echo $coordenadas[0] . ", " . $coordenadas[1]; ?>]),
          zoom: 9
        })
      });
    </script>

		<?php
			// Libera la memoria ocupada por el resultado 
			$provincias->close(); 
			// Cierra la conexión 
			$mysqli->close();
		?>
	</body>
</html>