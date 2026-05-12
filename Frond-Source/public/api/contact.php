<?php
// Mobatech Holland B.V. contactformulier endpoint
// PHP 7.2 compatible. Upload deze file mee naar /api/contact.php.

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Method not allowed';
    exit;
}

function clean_input($value) {
    $value = isset($value) ? $value : '';
    $value = trim($value);
    $value = strip_tags($value);
    $value = str_replace(array("\r", "\n"), ' ', $value);
    return $value;
}

function clean_message($value) {
    $value = isset($value) ? $value : '';
    $value = trim($value);
    $value = strip_tags($value);
    $value = str_replace(array("\r\n", "\r"), "\n", $value);
    return $value;
}

$naam = clean_input(isset($_POST['naam']) ? $_POST['naam'] : '');
$email = clean_input(isset($_POST['email']) ? $_POST['email'] : '');
$telefoon = clean_input(isset($_POST['telefoon']) ? $_POST['telefoon'] : '');
$bericht = clean_message(isset($_POST['bericht']) ? $_POST['bericht'] : '');
$website = clean_input(isset($_POST['website']) ? $_POST['website'] : '');

// Honeypot: spambots vullen dit verborgen veld vaak in.
if ($website !== '') {
    header('Location: /?contact=success#contact');
    exit;
}

if ($naam === '' || $email === '' || $bericht === '') {
    http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Niet alle verplichte velden zijn ingevuld.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Ongeldig e-mailadres.';
    exit;
}

if (strlen($naam) > 120 || strlen($email) > 180 || strlen($telefoon) > 80 || strlen($bericht) > 5000) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'De ingevoerde tekst is te lang.';
    exit;
}

$to = 'info@mobatech.nl';
$subject = 'Nieuw contactformulier via Mobatech Holland website';

$body = "Er is een nieuw bericht ontvangen via de website van Mobatech Holland B.V.\n\n";
$body .= "Naam: " . $naam . "\n";
$body .= "E-mail: " . $email . "\n";
$body .= "Telefoon: " . ($telefoon !== '' ? $telefoon : '-') . "\n\n";
$body .= "Bericht:\n" . $bericht . "\n\n";
$body .= "---\n";
$body .= "Verzonden vanaf: " . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'website') . "\n";
$body .= "IP-adres: " . (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-') . "\n";

$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'From: Mobatech Website <no-reply@mobatechholland.nl>';
$headers[] = 'Reply-To: ' . $naam . ' <' . $email . '>';
$headers[] = 'X-Mailer: PHP/' . phpversion();

$sent = mail($to, $subject, $body, implode("\r\n", $headers));

if (!$sent) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Verzenden mislukt. Probeer het later opnieuw of neem telefonisch contact op.';
    exit;
}

header('Location: /?contact=success#contact');
exit;
