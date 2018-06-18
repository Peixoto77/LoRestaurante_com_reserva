<?php
include_once('config.php');
$page = 'home';
$pagename = 'Home';
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("$incs/head.php") ?>
<body id="page1">

<?php include_once("$incs/topo.php") ?>

<section id="content">
  <div class="main">
    <div class="wrapper img-indent-bot">
    </div>
    <div class="wrapper">
      <article class="column-1">
        <div class="indent-left">
          <div class="maxheight indent-bot">
            <h3>Nossos Serviços</h3>
            <ul class="list-1">
              <li>Reserva Online</li>
              <li>Pratos a La Carte</li>
              <li>Rodízio Massas</li>
              <li>Rodízio de Carnes</li>
              <li>IFood</li>
            </ul>
          </div>
      </article>
      <article class="column-2">
        <div class="maxheight indent-bot">
          <h3 class="p1">Sobre o Lo Restorant</h3>
          <h6 class="p2">Situado na região central de Hortolândia Lo Restorant oferece serviços diferenciados, para um público que procura um ambiente agradável e familiar.</h6>
    </div>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
  
</footer>
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
$(window).load(function () {
    $('.slider')._TMS({
        duration: 1000,
        easing: 'easeOutQuint',
        preset: 'slideDown',
        slideshow: 7000,
        banners: false,
        pauseOnHover: true,
        pagination: true,
        pagNums: false
    });
});
</script>
</body>
</html>
