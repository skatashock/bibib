<?php

require_once __DIR__.'/vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$crawler = $client->request('GET', 'http://www.jesoes.com/');

$status_code = $client->getResponse()->getStatus();

if($status_code == 200)
{
    $filter = $crawler
        ->filter('span.putih')
        ->reduce(function (Crawler $node, $i) {
            // filter even nodes
            return ($i % 2) == 0;
        });


    $result = array();

    $result['ayat'] = $filter->filter('b[style="color:ff0000"]')->text();
    $result['isi'] = $filter->filter('a + b')->text();

    print_r($result);
}