<?php
session_start();
if(empty($_SESSION))
    $_SESSION["loggedin"] = "false";
$realm = 'Restricted area';

//utilisateur => mot de passe
$users = array('laurent' => '1124Da');


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Texte utilisé si le visiteur utilise le bouton d\'annulation');
}

// analyse la variable PHP_AUTH_DIGEST
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']])){
        $_SESSION["loggedin"] ="false";
    die('Mauvaise Pièce d\'identité!');
    }


// Génération de réponse valide
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response){
    $_SESSION["loggedin"] ="false";
    die('Mauvaise Pièce d\'identitée!');
}

// ok, utilisateur & mot de passe valide
echo 'Vous êtes identifié en tant que : ' . $data['username'];
$_SESSION["loggedin"] ="true";

// fonction pour analyser l'en-tête http auth
function http_digest_parse($txt)
{
    // protection contre les données manquantes
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));
 
    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>