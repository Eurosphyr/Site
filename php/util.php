<?php 
function conectarAoBanco()
{
  $host = "pgsql.projetoscti.com.br";
  $port = "5432";
  $dbname = "projetoscti27";
  $user = "projetoscti27";
  $password = "721643";

  try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
    exit;
  }
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function enviaEmail($pDestinatario, $pNome, $pAssunto, $pHtml)
{
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/SMTP.php';

  //Variaveis de configuração do email(DEVE SER ALTERADO)
  $pRemetente = "mipron@projetoscti.com.br";
  $pSenha = "M1#pr0n2023";
  $pSMTP = "smtp.projetoscti.com.br";

  //Configuração do PHP, para exibir erros
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  try {
    $mail = new PHPMailer(); //Instancia a classe PHPMailer

    //Configuração do servidor de email
    $mail->IsSMTP(); //Define que a mensagem será SMTP
    $mail->Host = $pSMTP; //Endereço do servidor SMTP
    $mail->SMTPAuth = true; //Autenticação SMTP    
    $mail->SMTPSecure = 'tls'; //Tipo de segurança
    $mail->Port = 587; //Porta de comunicação SMTP
    $mail->Username = $pRemetente; //Usuário do servidor SMTP
    $mail->Password = $pSenha; //Senha do servidor SMTP
    $mail->SMTPDebug = 2; //Habilita o debug do SMTP
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verificar_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    ); //Permite que o PHPMailer aceite certificados SSL não confiáveis

    //Configuração dos emails do remetente e do destinatário
    $mail->setFrom($pRemetente, 'Mipron'); //email do remetente
    $mail->addReplyTo($pUsuario); //Email para respossta, caso não queira que o usuário responda, coloque no.reply@...
    $mail->addAddress($pDestinatario, $pNome); //email do destinatário

    //Conteúdo do email
    $mail->IsHTML(true); //Se o email vai ser em HTML ou não 
    $mail->Subject = $pAssunto; //O assunto do email
    $mail->Body = $pHtml; //O conteúdo(corpo) do email em HTML
    $mail->CharSet = 'UTF-8'; //Codificação do email
    $mail->AltBody = 'seu email nao suporta html'; //Uma mensagem avisando destinatário que o seu email não suporta HTML
    $enviado = $mail->Send(); //Envia o email

    //Verifica se o email foi enviado
    if ($enviado) {
      echo "E-mail enviado com sucesso!";
    } else {
      echo "Não foi possível enviar o e-mail.";
      echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
    }

    //Execeções da biblioteca PHPMailer e do PHP(Instaciamento da classe exception)
  } catch (Exception $e) {
    echo $e->errorMessage(); //mensagens de erro do PHPMailer 
  } catch (\Exception $e) {
    echo $e->getMessage(); //mensagens de erro do PHP
  }
}


function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
  //$lmin = 'abcdefghijklmnopqrstuvwxyz';
  $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $num = '1234567890';
  $simb = '!@#$%*-';
  $retorno = '';
  $caracteres = '';

  //$caracteres .= $lmin;
  if ($maiusculas) $caracteres .= $lmai;
  if ($numeros) $caracteres .= $num;
  if ($simbolos) $caracteres .= $simb;

  $len = strlen($caracteres);
  for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand - 1];
  }
  return $retorno;
}

function verificaEmail($paramEmail)
{
  $conn = conectarAoBanco();
  $select = $conn->query("SELECT email FROM tbl_usuario");
  while ($row = $select->fetch()) {
    $varEmail = $row['email'];
    if ($paramEmail == $varEmail) {
      return true;
    }
  }
  return false;
}

function ValorSQL($pConn, $pSQL)
{
  $linhas = $pConn->query($pSQL)->fetch();

  if ($linhas > 0) {
    return $linhas[0];
  } else {
    return "0";
  }
}

function ExecutaSQL($paramConn, $paramSQL)
{
  $linhas = $paramConn->exec($paramSQL);

  if ($linhas > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}
?>