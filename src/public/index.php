<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */

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
$app->get('/test/bidders', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $data = $request->getParsedBody();
    $bidders = $db[$data['type']][$data['purchaseID']]['bidders'];
    if (isset($data['bidID'])) {
        foreach ($bidders as $bidder) {
            if ($bidder['bidID'] == $data['bidID']) {
                $response->getBody()->write(json_encode($bidder));
            }
        }
    } else {
        $response->getBody()->write(json_encode($bidders));
    }
    return $response;
});

$app->get('/test/requesters', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $data = $request->getParsedBody();
    $requesters = $db[$data['type']][$data['purchaseID']]['requesters'];
    $response->getBody()->write(json_encode($requesters));
    return $response;
});

$app->get('/test/owner', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $data = $request->getParsedBody();
    $requesters = $db[$data['type']][$data['purchaseID']]['owner'];
    $response->getBody()->write(json_encode($requesters));
    return $response;
});

$app->post('/notify', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
});
$app->run();