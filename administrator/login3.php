<?php

$user = $_GET['usuario'];

// Inicia o cURL
$ch = curl_init();

// Define a URL original (do formulário de login)
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/controles/controller/loginController.php');
// curl_setopt($ch, CURLOPT_URL, 'http://www.superfavoritos.com.br/controller/loginController.php');

// Habilita o protocolo POST
curl_setopt ($ch, CURLOPT_POST, 1);

// Define os parâmetros que serão enviados (usuário e senha por exemplo)
curl_setopt ($ch, CURLOPT_POSTFIELDS, 'login='.$user.'&senha=123&sistema_id=1');
// curl_setopt ($ch, CURLOPT_POSTFIELDS, 'login=kalcarvalho&senha=ksc171180');

// Imita o comportamento patrão dos navegadores: manipular cookies
curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

// Define o tipo de transferência (Padrão: 1)
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

// Executa a requisição
$store = curl_exec ($ch);



// Define uma nova URL para ser chamada (após o login)
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/controles/administrator/index.php?p=produtos');
// curl_setopt($ch, CURLOPT_URL, 'http://www.superfavoritos.com.br/administrator/');

// Executa a segunda requisição
$content = curl_exec ($ch);

// Encerra o cURL
curl_close ($ch);

echo $content;

?>