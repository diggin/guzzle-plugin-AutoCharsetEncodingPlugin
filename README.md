Guzzle Plugin - auto convert charset encoding
======================================================

A bridge Diggin_Http_Charset & Guzzle3
This plugin enable auto convert charset encoding to UTF-8.

### Guzzle4
If you looking for Guzzle4.
  - https://github.com/sasezaki/guzzle4-charset-subscriber

### USAGE

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
