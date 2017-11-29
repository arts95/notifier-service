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
$app->get('/test/{type}/{purchaseID}/bidders', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $type = $request->getAttribute('type');
    $purchaseID = $request->getAttribute('purchaseID');
    $bidders = $db[$type][$purchaseID]['bidders'];
    $response->getBody()->write(json_encode($bidders));
    return $response;
});

$app->get('/test/{type}/{purchaseID}/bidders/{bidID}', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $type = $request->getAttribute('type');
    $purchaseID = $request->getAttribute('purchaseID');
    $bidID = $request->getAttribute('bidID');
    $bidders = $db[$type][$purchaseID]['bidders'];
    foreach ($bidders as $bidder) {
        if ($bidder['bidID'] == $bidID) {
            $response->getBody()->write(json_encode($bidder));
        }
    }
    return $response;
});

$app->get('/test/{type}/{purchaseID}/requesters', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $type = $request->getAttribute('type');
    $purchaseID = $request->getAttribute('purchaseID');
    $requesters = $db[$type][$purchaseID]['requesters'];
    $response->getBody()->write(json_encode($requesters));
    return $response;
});

$app->get('/test/{type}/{purchaseID}/owner', function (Request $request, Response $response) {
    $db = json_decode(file_get_contents('db.json'), 1);
    $type = $request->getAttribute('type');
    $purchaseID = $request->getAttribute('purchaseID');
    $owner = $db[$type][$purchaseID]['owner'];
    $response->getBody()->write(json_encode($owner));
    return $response;
});
$app->run();