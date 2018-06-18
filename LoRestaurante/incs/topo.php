<!--==============================header=================================-->
<header>
    <?php include_once("$incs/topo_menu.php");?>
    <div class="row-bot">
        <div class="row-bot-bg">
            <div class="main">
                <h2>Cada Momento... <bra> Uma Surpresa!!! </bra></h2>
                <?php if($page == 'home') { ?>
                <div class="slider-wrapper">
                    <div class="slider">
                        <ul class="items">
                            <li> <img src="<?php echo $imagens_path?>/slider-img1.jpg" alt="" /> </li>
                            <li> <img src="<?php echo $imagens_path?>/slider-img2.jpg" alt="" /> </li>
                            <li> <img src="<?php echo $imagens_path?>/slider-img3.jpg" alt="" /> </li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
<!--==============================content================================-->