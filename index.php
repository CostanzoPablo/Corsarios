<?php
include("./conectar.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Corsarios v1.0.4</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Corsarios</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="#about" data-toggle="modal" data-target="#formRegistrarse">Registrarse</a></li>
                <li><a href="#about" data-toggle="modal" data-target="#formIdentificarse">Identificarse / Jugar</a></li>
                <li><a href="#contact" data-toggle="modal" data-target="#formContacto">Contacto</a></
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>



<!-- Identificarse -->
<div class="modal fade" id="formIdentificarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Identificar Usuario</h4>
        <div id="formIdentificarseError" class="formError">&nbsp;</div>
      </div>
      <div class="modal-body">
        <form id="formularioIdentificarse" action="./login.php" method="POST">
          <input name="nick" id="nick" placeholder="Nick" type="text" class="defaultInput">
          <input name="pass" id="pass" placeholder="Clave" type="password" class="defaultInput">  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">CANCELAR</button>
        <a href="#" id="form-identificarse" class="btn btn-warning btn-lg ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">IDENTIFICARSE</span></a>
      </div>
    </div>
  </div>
</div>
<!-- //Identificarse -->

<!-- Registrarse -->
<div class="modal fade" id="formRegistrarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
        <div id="formRegistrarseError" class="formError">&nbsp;</div>
      </div>
      <div class="modal-body">
        <form id="formularioRegistrarse" action="./registrarse.php" method="POST">
          <div><input name="registrarseNick" id="registrarseNick" placeholder="Nick" type="text" class="defaultInput"></div>
          <div><input name="registrarseMail" id="registrarseMail" placeholder="E-Mail" type="text" class="defaultInput"></div>
          <div><input name="registrarseClave" id="registrarseClave" placeholder="Clave" type="password" class="defaultInput"></div>
          <div><input name="registrarseRclave" id="registrarseRclave" placeholder="Repetir Clave" type="password" class="defaultInput"></div>
          <div><input id="formRegistrarseAcepto" type="checkbox" value="acepto"><a href="./index.php?seccion=terminos" target="_blank">&nbsp;Acepto los Términos y condiciones</a> y la <a href="./index.php?seccion=politica" target="_blank">Política de privacidad</a></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">CANCELAR</button>
        <a href="#" id="form-registrarse" class="btn btn-warning btn-lg ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">REGISTRARSE</span></a>
      </div>
    </div>
  </div>
</div>
<!-- //Registrarse -->

<!-- Contacto -->
<div class="modal fade" id="formContacto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
        <div id="formContactoError" class="formError">&nbsp;</div>
      </div>
      <div class="modal-body">
        <form id="formularioContacto" action="./contacto.php" method="POST">
          <div><select name="contactoSeccion" id="contactoSeccion">
            <option value="comentario">Comentario</option>
            <option value="sugerencia">Sugerencia / Idea</option>
            <option value="bug">Bug</option>
          </select></div>
          <div><input name="contactoMail" id="contactoMail" placeholder="E-Mail" type="text" class="defaultInput"></div>
          <div><textarea name="contactoMensaje" id="contactoMensaje" placeholder="Tu mensaje..."></textarea></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">CANCELAR</button>
        <a href="#" id="form-contacto" class="btn btn-warning btn-lg ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">ENVIAR</span></a>
      </div>
    </div>
  </div>
</div>
<!-- //Contacto -->
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="./images/fempireA.png" alt="0 slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Con el mouse haciendo click sobre el agua, decidis a donde viajar</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="./images/fempireD.png" alt="0 slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Manteniendo click y arrastrando el mouse sobre el agua, podes ver 360</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="./images/fempireB.png" alt="0 slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Haciendo click sobre tu barco, podes mejorarlo, pescar o repararlo</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="./images/fempireC.png" alt="0 slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Haciendo click sobre monstruos u otros jugadores, podes atacarlos</p>
            </div>
          </div>
        </div>        
        <div class="item">
          <img src="./images/fempireE.png" alt="0 slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Al derrotar un monstruo u otro barco, podes capturar el cofre que deja caer al agua</p>
            </div>
          </div>
        </div>        
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <h2>OPEN SOURCE</h2>
          <p>Corsarios utiliza la licencia GNU General Public License (GPL). El objetivo del proyecto es que el codigo sea compartido, mejorado y distribuido libremente para el aprendizaje del desarrollo de video juegos. <a href="https://github.com/CostanzoPablo/Corsarios" target="_blank">Link del repositorio en github</a></p>
          <img src="./images/gpl.png" width="371" height="185">
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h2>Tecnologia de punta</h2>
          <p>WebGL es una API multiplataforma destinada a crear gráficos 3D en navegadores web. Se basa en un conocido y ampliamente aceptado estándar de gráficos 3D (OpenGL). Compatibilidad con distintos navegadores y plataformas. Gráficos 3D acelerados por hardware (CPU y tarjeta gráfica).</p>
          <img src="./images/webgl.jpg">
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h2>Powered by</h2>
          <img src="./images/html5.png" width="20%">
          <img src="./images/css.png" width="20%">
          <img src="./images/js.png" width="20%">
          <img src="./images/php.png" width="20%">
          <img src="./images/mysql.png" width="20%">
          <img src="./images/jquery.png" width="20%">
          <img src="./images/three.png" width="20%">
          <img src="./images/bootstrap.png" width="20%">
          <img src="./images/github.png" width="20%">
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

	  <div class="row">
	  	   <h2>Agradecimiento</h2>
	  	   <div>Poder llegar a coordinar e iniciar el desarrollo de este proyecto, fue gracias al centro de estudiantes La Fuente - UNLP - Informatica quien creo el area UIV (Unidad de Investigacion de Video Juegos)</div>
	  	   <div><img src="./images/lafuente.png"></div>
	  </div>
	  
	  <div class="row">
	  	   <div><h2>Jugadores</h2><b>Nick - Ultimo acceso</b></div>
	  	   <?php
            $total=0;
        	$sql=mysql_query("SELECT * FROM players ORDER by uclick DESC",$con);
        	while($row = mysql_fetch_array($sql)){
        		$total++;
        		echo $row["nick"].' - '.date("d/m/Y H:i", $row["uclick"]).'<br>';
        	}	
        	echo '<br>
        	<b>Total: '.$total.'</b><br>';
	  ?>
	  </div>
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; Copyleft 2014 Corsarios. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
	  
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/ladda-themeless.min.css">
    <script src="./js/spin.min.js"></script>
    <script src="./js/ladda.min.js"></script>
    <script src="./js/functions.js"></script>    
    <script src="./js/identificarse.js"></script>
    <script src="./js/registrarse.js"></script>
    <script src="./js/contacto.js"></script>
  </body>
</html>
