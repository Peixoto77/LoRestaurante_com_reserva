<?php
// Site dependent (db conection):
include_once "bd.php";
//include_once "mailchimp_inc.php"; //Dados do MailChimp

// Localizacao dos arquivos PHP
if (!isset($raiz))
    $raiz = "";

$incs = "$_SERVER[DOCUMENT_ROOT]/${raiz}incs";
$imagens_path = "/${raiz}images";

const DATE_FORMAT = 'd/m/Y';
const DATE_FORMAT_US = 'Y-m-d';

// Localizacao dos arquivos .js e outras bibliotecas que tem arquivos num lugar visivel publicamente.
$js = "/${raiz}js";
$css = "/${raiz}css";
$incsfe = "/${raiz}incs";

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;             // Enable verbose debug output

$mail->isSMTP();                    // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'lorestauranteprojeto@gmail.com';               // SMTP username
$mail->Password = '1983restau';               // SMTP password
$mail->SMTPSecure = 'ssl';          // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->setFrom('no-reply@lorestaurante.com', 'Lo Restaurante');
$mail->addReplyTo('no-reply@lorestaurante.com', 'Lo Restaurante');
$mail->isHTML(true);

require_once("$incs/funcoes.php");
