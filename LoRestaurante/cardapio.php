<?php
include_once('config.php');
$page = 'cardapio';
$pagename = 'Cardápio';
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("$incs/head.php") ?>
<body id="page2">
<?php include_once("$incs/topo.php") ?>
<section id="content">
  <div class="main">
    <div class="wrapper">
      <article class="col-1">
        <div class="indent-left">
          <div class="img-indent-bot">
            </div>
          <h3 class="p2">Cardápio !!!</h3>
            <div>
              <div class="p2">
                 <figure><a href="#"><img src="<?php echo $imagens_path?>/page2-img1.jpg" alt=""></a></figure>
                <h5>Massas</h5>
                 </div>           
                 <figure><a href="#"><img src="<?php echo $imagens_path?>/page2-img10.jpg" alt=""></a></figure>
                <h5>Carnes Nobres</h5>
                 </div>
                 <figure><a href="#"><img src="<?php echo $imagens_path?>/page2-img3.jpg" alt=""></a></figure>
                <h5>Entradas / Aperitivos</h5>
                </div>
                 <figure><a href="#"><img src="<?php echo $imagens_path?>/page2-img7.jpg" alt=""></a></figure>
                 <h5>A La Carte</h5>
                
      </article>
      <article class="col-2">
        <h3>Preços</h3>
        <ul class="price-list p2">
          <li><span>R$ 39,90</span>Rodizio de Massas</li>
          <li><span>R$ 49,90</span>Rodizio de Carnes</li>
          <li><span>R$ 89,00</span>A La Carte</li>
          <li><span>R$ 19,90</span>Sobremesas</li>
</section>
<!--==============================footer=================================-->
<footer>
  <div class="main">
</footer>
<script type="text/javascript">Cufon.now();</script>
</body>
</html>
