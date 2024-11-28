<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
        die('You have already submitted the form. Please do not resubmit.');
    }


    $name = $_POST["name"] ?? "";
    $phone = $_POST["phone"] ?? "";

    if (empty($name) || empty($phone)) {
        die('Please require fields!');
    }

    $data = [
        'stream_code' => 'vv4uf',
        'client' => [
            'name' => $name,
            'phone' => $phone
        ]
    ];


    $client = new Client(['headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer RLPUUOQAMIKSAB2PSGUECA']]);
    $response = $client->post('https://order.drcash.sh/v1/order', ['json' => $data]);

    if ($response->getStatusCode() == 200) {
        $_SESSION['form_submitted'] = true;
        header('Location: thanks.html');
        exit;
    }else {
        die('Something went wrong!');
    }

}else {
    die('Something went wrong, not post request');
}
