<?php

    class PRINCIPAL_VIEW{

        function __construct(){
            $this->render();
        }

        function render(){
            include '../Views/Header_View.php';
        

                ?>
    <div id="myCarousel" class=" mx-auto d-block carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block w-100" src="../Views/img/intro/slide1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-left">
              <h1>Disfruta en nuestras instalaciones</h1>
              <p>Pistas y equipamiento de primer nivel</p>
              <p><a class="btn btn-lg btn-primary" href="#dnde" role="button">Donde encontrarnos?</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../Views/img/intro/slide2.jpg"   alt="Second slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block">
              <h1>Clases particulares</h1>
              <p>Nos adaptamos a tu nivel para hacerte mejorar o aprender</p>
              <p><a class="btn btn-lg btn-primary" href="#cntc" role="button">Sobre nosotros</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../Views/img/intro/slide3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
              <h1>Campeonatos</h1>
              <p>Participa en nuestros campeonatos!</p>
              <p><a class="btn btn-lg btn-primary disabled" href="./html/Catalogo.html" role="button" >Catálogo de productos</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="container marketing">

<!-- Three columns of text below the carousel -->
<div class="row">
  <div class="col-lg-4">
    <img class="rounded-circle" src="../Views/img/intro/img1.jpg" alt="Generic placeholder image" width="130" height="130">
    <h2>Clases particulares</h2>
    <p><ul>loren ipsu</ul>
       </p>
    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
    <img class="rounded-circle" src="../Views/img/intro/img2.jpg" alt="Generic placeholder image" width="130" height="130">
    <h2>Campeonatos</h2>
    <p>Niveles
    <ul>Categorias</ul>
    <ul>Premios metalicos</ul>
    <ul>Competitiividad aseguradas</ul></p>
    <p><a class="btn btn-secondary" href="../Controllers/Campeonato_Controller.php?accion=SHOWALL" role="button">View details &raquo;</a></p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
    <img class="rounded-circle" src="../Views/img/intro/img3.jpg" alt="Generic placeholder image" width="130" height="130">
    <h2>Partidos promocionados</h2>
    <p><ul>Inscribite</ul>
   <ul>Conoce gente</ul> </p>
    <p><a class="btn btn-secondary" href="../Controllers/PPromocionado_Controller.php?accion=SHOWALL" role="button">View details &raquo;</a></p>
  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->


<!-- START THE FEATURETTES -->

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Padel por aqui <span class="text-muted">Padel por alla</span></h2>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisi lorem, iaculis sit amet magna et, finibus tempor neque. Suspendisse gravida, lacus nec viverra mattis, leo sapien molestie nunc, auctor dapibus sapien metus eu elit. Quisque at aliquam massa. Aliquam bibendum lorem lorem, eu tempus ex sollicitudin ut. In semper nulla ut odio posuere, quis elementum eros condimentum. Nullam cursus massa ac maximus malesuada. Praesent sodales at orci nec lobortis. Donec pharetra arcu at dignissim semper. Ut mattis sodales pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam nunc lorem, fringilla et lorem eu, facilisis iaculis turpis. Pellentesque at elit vitae ipsum suscipit luctus. Etiam tempus felis vitae turpis sodales, ac viverra felis ultrices. Curabitur condimentum euismod rutrum. Duis pulvinar turpis a tortor tristique, non ultrices sem auctor. </p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="../Views/img/intro/imgGrande2.jpg" alt="Generic placeholder image">
  </div>
</div>

<hr id="cntc" class="featurette-divider">

<div  class="row featurette">
  <div class="col-md-7 push-md-5">
    <h2 class="featurette-heading">Tienes dudas? <span class="text-muted">Contáctanos!</span></h2>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisi lorem, iaculis  <a href="#dnde">venir a vernos</a>. Preguntenos sin compromiso.</p>
  </div>
  <div class="col-md-5 pull-md-7">
    <img class="featurette-image img-fluid mx-auto" src="../Views/img/intro/imgGrande3.jpg" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<div id="dnde" class="row featurette">
  <div  class="col-md-7">
      <h2 class="featurette-heading">Dónde encontrarnos?<span class="text-muted">
          Ven sin compromiso!</span></h2>
      <p class="lead">Horario de 8:00 a 13:00 por la mañana
          y de 16:00 a 20:00 por la tarde, de lunes a viernes!</p>

    </div>
  <div class="col-md-5">
      <iframe class="featurette-image  " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2951.3298842683384!2d-7.815316684545845!3d42.29282597919147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2fff8e64880b21%3A0x4fb73e5158ea3fe4!2siPadel%20Sports!5e0!3m2!1ses!2ses!4v1574025092133!5m2!1ses!2ses" width="400" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

  </div>
</div>

<hr class="featurette-divider">



</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="../../assets/js/vendor/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

 <?php
			include 'Footer_View.php';
		} //fin metodo render

	} //fin Login

?>
