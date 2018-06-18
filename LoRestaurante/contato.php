<?php
include_once('config.php');
$page = 'contato';
$pagename = 'Contato';

init_ajax();

// variaveis ajax
$ajax = ifset($_REQUEST['ajax'],"");

function get_dynamic_content() {
    global $ajax;
    switch ($ajax) {
        case "valida_contato":
            return valida_contato(); break;
    }
    return NULL;
}

function valida_contato() {
    global $mysqli;
    global $mail;
    $nome = ifset($_REQUEST['name'],"");
    $email = ifset($_REQUEST['email'],"");
    $mensagem = ifset($_REQUEST['mensagem'],"");

    $error = "";

    if(empty($nome))
        $error .= "- Nome<br/>";
    if(empty($email)) {
        $error .= "- Email<br/>";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "- Email inválido<br/>";
        }
    }
    if(empty($mensagem))
        $error .= "- Mensagem";

    if(!empty($error)){
        return array ("error" => true, "msg"=> "Os seguintes campos são obrigatórios:<br/>".$error);
    }

    //Senão tem erros grava na tabela e envia o email

    //grava na tabela
    $insert= mysqli_query($mysqli, "INSERT INTO contato(nome,email,mensagem)VALUES('$nome','$email','$mensagem')");

    //envia o email
    $mail->addAddress($email, $nome);     // Add a recipient
    $mail->Subject = 'Solicitação de contato';
    $mail->Body    = 'Nome: <b>'.$nome.'</b><br>Email: <b>'.$email.'</b><br>Mensagem: <b>'.nl2br($mensagem).'</b>';
    $mail->AltBody = 'Nome:'.$nome.', Email: '.$email.', Mensagem: '.($mensagem);

    return array('sucesso' => true, 'status_envio' => $mail->send());
}

exec_ajax('get_dynamic_content');
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("$incs/head.php") ?>
<body id="page6">
<?php include_once("$incs/topo.php") ?>
<section id="content">
    <div class="blackout_loading"></div>
  <div class="main">
    <div class="wrapper">
      <article class="col-1">
        <div class="indent-left">
          <h3 class="p1">Contatos</h3>
          <figure class="indent-bot">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.778269232765!2d-47.22558898545698!3d-22.884647885023085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8bbe63e62a7b3%3A0xe43702250d599b8c!2sR.+Otaviano+de+Figueredo+Beda%2C+444+-+Lot.+Adventista+Campineiro%2C+Hortol%C3%A2ndia+-+SP!5e0!3m2!1spt-BR!2sbr!4v1527007450161" width="300" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
          </figure>
          <dl>
            <dt class="p1">Hortolândia - Brazil</dt>
            <dd><bra>Telefone:</bra> +55 19 3333-3333</dd>
              <dd><bra>Fax:</bra> +55 19 3232-1212</dd>
            <dd><bra>Email:</bra><a class="color-2" href="#">contato@lorestorant.com.br</a></dd>
          </dl>
        </div>
      </article>
      <article class="col-2">
        <h3 class="p1">Contato</h3>
          <div class="alert alert-danger hide" role="alert">

          </div>
        <form id="contact-form" action="#" method="post" enctype="multipart/form-data">
          <fieldset>
            <label><bra class="text-form">Nome:</bra>
              <input id="name" name="name" type="text" />
            </label>
            <label><bra class="text-form">E-mail:</bra>
              <input id="email" name="email" type="text" />
            </label>
            <div class="wrapper">
              <div class="text-form">Mensagem:</div>
              <div class="extra-wrap">
                <textarea id="mensagem" name="mensagem"></textarea>
                <div class="clear"></div>
                <div class="buttons"> <a class="button-2" href="javascript:limpa_form('contact-form');">Limpar</a> <a class="button-2" href="javascript:exec_ajax('valida_contato')" id="btnEnviarContato">Enviar</a> </div>
              </div>
            </div>
          </fieldset>
        </form>
      </article>
    </div>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
  <div class="main">
    <div class="aligncenter"> <bra><a href="#"></a> </bra>  <a target="_blank" href="http://www.templatemonster.com/"></a> </div>
  </div>
</footer>
<script type="text/javascript">Cufon.now();</script>
<script>
    function limpa_form(formulario) {
        document.getElementById(formulario).reset();

        $('.alert').html('');
        $('.alert').addClass('hide').addClass('alert-danger');
    }

    function exec_ajax(ajax) {

        $('.blackout_loading').css('display', 'block');

        parametros = {
            ajax: ajax,
            name: $("input[name=name]").val(),
            email: $("input[name=email]").val(),
            mensagem: $("textarea[name=mensagem]").val(),

        };

        $.ajax( { url: '<?php echo $_SERVER['PHP_SELF']?>', data: parametros, type: 'POST', dataType: 'json', success: function(data) { trata_ajax(data) }, async: true } );
    }

    function trata_ajax(data) {
        if (data.alert) {
            alert(data.alert);
        }

        if(data.error) {
            $('.alert').html(data.msg);
            $('.alert').removeClass('hide').removeClass('alert-success').addClass('alert-danger');
        }

        if(data.sucesso) {
            $('.alert').html('Solicitação de contato enviada com sucesso!');
            $('.alert').removeClass('hide').removeClass('alert-danger').addClass('alert-success');
            document.getElementById('contact-form').reset();
        }

        $('.blackout_loading').css('display', 'none');
    };

</script>
</body>
</html>
