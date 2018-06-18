<head>
    <title>Lo Restorant.com.br <?php echo ($page != 'home' ? '| '.$pagename : '')?></title>
    <meta charset="utf-8">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo $imagens_path?>/favicon.ico">

    <link rel="stylesheet" href="<?php echo $css?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $css?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $css?>/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $css?>/jquery-ui.css">
    <script src="<?php echo $js?>/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/cufon-replace.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/Dynalight_400.font.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/FF-cash.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/tms-0.3.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/tms_presets.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo $js?>/jquery.equalheights.js" type="text/javascript"></script>

    <?php if($page == 'reserva') { ?>
    <script src="<?php echo $js?>/jquery-1.12.4.js"></script>
    <script src="<?php echo $js?>/jquery-ui.js"></script>
    <script src="<?php echo $js?>/jquery-mask-min.js"></script>
    <?php } ?>


    <?php if($page == 'cardapio') { ?>
    <script src="js/jquery.bxSlider.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#slider').bxSlider({
                pager: true,
                controls: false,
                moveSlideQty: 1,
                displaySlideQty: 3
            });
        });
    </script>
    <?php } ?>
</head>