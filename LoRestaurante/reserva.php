<?php
include_once('config.php');
$page = 'reserva';
$pagename = 'Reservas';

init_ajax();

// variaveis ajax
$ajax = ifset($_REQUEST['ajax'],"");

function get_dynamic_content() {
    global $ajax;
    switch ($ajax) {
        case "reservar":
            return reservar(); break;
    }
    return NULL;
}

function reservar() {
    global $mysqli;
    global $mail;
    $nome_reserva = ifset($_REQUEST['nome_reserva'], '');
    $cpf_reserva = ifset($_REQUEST['cpf_reserva'], '');
    $id_mesa = ifset($_REQUEST['id_mesa'], 0)+0;
    $data_reserva = ifset($_REQUEST['data_reserva'], '');
    $email = ifset($_REQUEST['email'], '');

    $error = "";

    if(empty($data_reserva))
        $error .= "- Data da Reserva<br/>";
    if($id_mesa <= 0)
        $error .= "- Mesa <br/>";
    if(empty($nome_reserva))
        $error .= "- Nome<br/>";
    if(empty($cpf_reserva)) {
        $error .= "- CPF <br/>";
    } else {
        if(!validar_cpf($cpf_reserva)) { //CPF falso
            $error .= "- CPF inválido<br/>";
        }
    }
    if(empty($email)) {
        $error .= "- Email";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "- Email inválido";
        }
    }

    if(!empty($error)){
        return array ("error" => true, "msg"=> "Os seguintes campos são obrigatórios:<br/>".$error);
    }

    $data_tratada = (conv_data_us(grava_data($data_reserva)));

    //Faço as validações para verificar se posso salvar
    $result = mysqli_query($mysqli,"SELECT id_reserva FROM reserva WHERE data_reserva='$data_tratada' and id_mesa='$id_mesa' LIMIT 1");
    $tem_reserva = mysqli_fetch_row($result);

    if(!empty($tem_reserva)){
        return array ("error" => true, "msg"=> "Os seguintes campos são obrigatórios:<br/>Já existe reserva salva para a data e mesa selecionada.<br />Tente novamente.");
    } else {
        //gera um codigo aleatorio
        $codigo_reserva = geraSenha(6,true,true);

        //Cria a reserva e envia a notificação com o código da reserva
        $insert= mysqli_query($mysqli, "INSERT INTO reserva (id_mesa, data_reserva, nome_reserva, email, cpf_reserva, codigo_reserva) VALUES ('$id_mesa', '$data_tratada', '$nome_reserva', '$email', '$cpf_reserva', '$codigo_reserva')");
    }

    //envia o email
    $mail->addAddress($email, $nome_reserva);     // Add a recipient
    $mail->Subject = 'Solicitação de reserva';
    $mail->Body    = 'Nome: <b>'.$nome_reserva.'</b><br>Data reserva: <b>'.$data_reserva.'</b><br>Email: <b>'.$email.'</b><br>CPF: <b>'.$cpf_reserva.'</b><br>Codigo da reserva: <b>'.($codigo_reserva).'</b>';
    $mail->AltBody = 'Nome:'.$nome_reserva.', Data reserva: '.$data_reserva.', Email: '.$email.', CPF: '.$cpf_reserva.', Codigo da reserva: '.($codigo_reserva);

    return array('sucesso' => true, 'status_envio' => $mail->send());
}

exec_ajax('get_dynamic_content');
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("$incs/head.php") ?>
<style>
    #content { min-height: 551px;}
</style>
<body id="page7">
<?php include_once("$incs/topo.php") ?>
<section id="content">
    <div class="blackout_loading"></div>
  <div class="main">
    <div class="wrapper">
      <article class="col-2">
        <h3 class="p1">Reserva</h3>
          <div class="alert alert-danger hide" role="alert"></div>
          <p>
              Todas as reservas de Mesas são para o período noturno (das 18:00 às 23:59)
          </p>
        <form id="reserva-form" action="#" method="post" enctype="multipart/form-data">
          <fieldset>

              <label><bra class="text-form">Data:</bra>
                  <input type="text" id="data_reserva" name="data_reserva">
              </label>
              <label><bra class="text-form">Mesa:</bra>
                  <select id="mesa" name="mesa">
                    <option value="0" >:: Selecione ::</option>
                      <?php
                        $result = mysqli_query($mysqli,"SELECT id_mesa, nome FROM mesa ORDER BY id_mesa");

                        while($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['id_mesa']?>"><?php echo $row['nome']?></option>
                      <?php }

                      mysqli_close($mysqli);
                      ?>
                  </select>
              </label>

            <label><bra class="text-form">Nome:</bra>
              <input id="nome_reserva" name="nome_reserva" type="text" />
            </label>
              <label><bra class="text-form">E-mail:</bra>
                  <input id="email" name="email" type="text" />
              </label>
            <label><bra class="text-form">CPF:</bra>
              <input id="cpf_reserva" name="cpf_reserva" type="text" />
            </label>

              <div class="clear"></div>
              <div class="buttons"> <a class="button-2" href="javascript:limpa_form('reserva-form');">Limpar</a> <a class="button-2" href="javascript:exec_ajax('reservar')" id="btnEnviarContato">Reservar</a> </div>
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

    $( function() {

        $("#cpf_reserva").mask("999.999.999-99");

        $.datepicker.regional['pt'] = {
            closeText: 'Fechar',
            prevText: '<Anterior',
            nextText: 'Seguinte',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S&aacute;bado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            weekHeader: 'Sem',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['pt']);

        var today = new Date();
        $('#data_reserva').datepicker({
            startDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
            minDate: 0, //A partir da da atual
            beforeShowDay: function(date) { //Desativa os domingos
                var day = date.getDay();
                return [(day != 0), ''];
            }
        })
    } );


    function limpa_form(formulario) {
        document.getElementById(formulario).reset();

        $('.alert').html('');
        $('.alert').addClass('hide').addClass('alert-danger');
    }

    function exec_ajax(ajax) {

        $('.blackout_loading').css('display', 'block');

        parametros = {
            ajax: ajax,
            nome_reserva: $("input[name=nome_reserva]").val(),
            email: $("input[name=email]").val(),
            cpf_reserva: $("input[name=cpf_reserva]").val(),
            id_mesa: $("select[name=mesa]").val(),
            data_reserva: $("input[name=data_reserva]").val(),

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
            $('.alert').html('Solicitação de reserva enviada com sucesso!');
            $('.alert').removeClass('hide').removeClass('alert-danger').addClass('alert-success');
            document.getElementById('reserva-form').reset();
        }

        $('.blackout_loading').css('display', 'none');
    };

</script>
</body>
</html>
