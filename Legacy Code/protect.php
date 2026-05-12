<?php
$gebruikersnaam = "moba";
$wachtwoord = "moba"; // zelf aanpassen

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Mobatech beveiligd"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Toegang geweigerd';
    exit;
} else {
    if (
        $_SERVER['PHP_AUTH_USER'] != $gebruikersnaam ||
        $_SERVER['PHP_AUTH_PW'] != $wachtwoord
    ) {
        header('WWW-Authenticate: Basic realm="Mobatech beveiligd"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Onjuiste login';
        exit;
    }
}
?>