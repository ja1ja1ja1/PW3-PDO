<?php
namespace sistema\nucleo;


class Helpers{

public static function dataAtual():string

{

  $diaMes = date('d');

  $diaSemana = date('w');

  $mes = date('n') -1;

  $ano = date('Y');

 

  $nomesDiasdaSemana = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];

  $nomesMeses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembo','Dezembro'];

  $dataformatada = $nomesDiasdaSemana[$diaSemana].", ".$diaMes." de ".$nomesMeses[$mes]." de ".$ano;

  return $dataformatada;

}
public static function resumirTexto(string $texto, int $limite, string $continue = "..."):string
{

  $textoLimpo = trim($texto);
  if($textoLimpo <= $limite){
    return $textoLimpo;
  }

  $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo,0,$limite),''));

  return $resumirTexto.$continue;
}
public static function url(string $url = null): string

{

  $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

  $ambiente = ($servidor == self::localhost()? URL_DESENVOLVIMENTO : URL_PRODUCAO);  

  if(str_starts_with($url, '/'))

  {

    return $ambiente.$url;

  }

  return $ambiente."/".$url;

}



public static function localhost():bool
{

  $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

  if($servidor == 'localhost'){

    return true;

  }

  return false;

}

public static function saudacao():string

{

  $hora = date('H');

  $saudacao = match(true){

    $hora >= 0 && $hora <= 5 => 'Boa madrugada',

    $hora >= 6 && $hora <= 12 => 'Bom dia',

    $hora >= 12 && $hora <= 18 => 'Boa tarde',

    default => 'Boa noite'

  };

  return $saudacao;

}
}