<?php
function ifset(&$a, $b)
{
    return (isset($a) ? $a : $b);
}

// Funcao para inicializar o ajax. Prinicipalmente limpa o ajax=1 do REQUEST_URI para a paginacao nao se perder.
function init_ajax()
{
    global $ajax;
    if (!empty($_REQUEST['ajax'])) {
        $_SERVER['REQUEST_URI'] = preg_replace('#ajax=[^&]*#', '', $_SERVER['REQUEST_URI']);
        $ajax = $_REQUEST['ajax'];
    }
}

// Executa o ajax. (verifica o $_GET['ajax'], e sai do php se for interpretado).
function exec_ajax($result_function)
{
    if (!empty($_REQUEST['ajax'])) {
        echo json_encode($result_function());
        exit;
    }
}

//gera senha aleatoria
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
}

function grava_data($date)
{
    return interpret_datetime($date);
}


function conv_data($date)
{
    if (is_string($date))
        $date = interpret_datetime($date);
    if (!$date)
        return '';
    return @date_format($date, DATE_FORMAT);
}

function conv_data_us($date)
{
    if (is_string($date))
        $date = interpret_datetime($date);
    if (!$date)
        return '';
    return @date_format($date, DATE_FORMAT_US);
}

function interpret_date($input)
{
    $date = date_create_from_format('d/m/Y', $input);
    if (!$date)
        $date = date_create_from_format('d/m', $input);
    if (!$date)
        $date = date_create_from_format('Y-m-d', $input);
    if (!$date)
        $date = date_create_from_format('d-m-Y', $input);
    if (!$date)
        $date = date_create_from_format('d-m', $input);
    if ($date)
        $date->setTime(0,0,0);

    return $date;
}

function interpret_datetime($input)
{
    if (!is_string($input))
        return $input;
    if (strpos($input, ' ') == 0 && strpos($input, 'T') == 0) {
        if (strpos($input, ':') > 0 || strpos($input, 'h') > 0)
            return interpret_time($input);
        return interpret_date($input);
    }
    $date = date_create_from_format('Y-m-d H:i:s', $input);
    if (!$date)
        $date = date_create_from_format('d/m/Y H:i', $input);
    if (!$date)
        $date = date_create_from_format('d/m/Y H:i:s', $input);
    if (!$date)
        $date = date_create_from_format('d/m H:i:s', $input);
    if (!$date)
        $date = date_create_from_format('Y-m-d\\TH:i:s', $input);
    return $date;
}

function validar_cpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

    $invalidos = array('00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999');

    if (in_array($cpf, $invalidos))
        return false;

    // Valida tamanho
    if (strlen($cpf) != 11)
        return false;
    // Calcula e confere primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Calcula e confere segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}