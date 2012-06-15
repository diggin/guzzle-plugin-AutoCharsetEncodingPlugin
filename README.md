Diggin - Guzzle AutoCharsetEncoding plugin
==========================================

A bridge Diggin_Http_Charset & Guzzle
This plugin enable auto-encode to UTF-8.

USAGE
-----

- use in Goutte

``` php
<?php

use Diggin\Bridge\Guzzle\AutoCharsetEncodingPlugin\AutoCharsetEncodingPlugin;

$autoCharsetEncodingPlugin = new AutoCharsetEncodingPlugin;

$client = new Goutte\Client;
$client->getClient()->getEventDispatcher()->addSubscriber($autoCharsetEncodingPlugin);

$crawler = $client->request('GET', 'http://www.kms.gol.com/benkyo/ben1.htm');
$title = $crawler->filterXpath('//title')->text();
echo $title; // ①文書情報マネジメントとは？

```
