<?php

use AndremeirelesPipefy\CreateCard;
use AndremeirelesPipefy\Query;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$newEnv = new CreateCard();
$newEnv->create(cardTitle: 'novo cartão criado de uma api qualquer', pipeId: 301897278);
// $query = new Query();
// $response = $query->getOrganizationUsers(296765);
// $users = $response['data']['organization']['members'];
// foreach ($users as $key => $user) {
//     $data = $user['user'];
//     echo sprintf('user index %s - name %s', $key < 10 ? '0' . $key : $key, $data['name']) . PHP_EOL;
// }