<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */

use app\entity\tender\TenderEntity;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($configuration);
$app->get('/', function (Request $request, Response $response) {
    $data = file_get_contents('auction.json');
    $tender = new \app\entity\auction\AuctionEntity(json_decode($data, 1), 'data');
    echo "<pre>";
    var_dump($tender->getContracts());
    $response->getBody()->write("It is notifier service");

    return $response;
});

$app->post('/notify', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
});
$app->run();