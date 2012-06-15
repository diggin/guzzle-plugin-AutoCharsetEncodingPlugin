<?php
namespace Diggin\Bridge\Guzzle\AutoCharsetEncodingPlugin

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Diggin\Http\Charset\Filter;
use Diggin\Http\Charset\Front\UrlRegex;

class AutoCharsetEncodingPlugin implements EventSubscriberInterface
{
    protected $charset_front;

    public function getCharsetFront()
    {
        if (!$this->charset_front) {
            $this->charset_front = new UrlRegex;
        }

        return $this->charset_front;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array('request.complete' => 'onRequestComplete');
    }

    /**
     * {@inheritdoc}
     */
    public function onRequestComplete(Event $event)
    {
        if ($res = $event['request']->getResponse()) {
            $contentType = $res->getHeader('content-type', true);
            $bodyEntity = $res->getBody(false);
            $body = $this->getCharsetFront()
                ->convert((string)$bodyEntity, array(
                    'content-type' => $contentType,
                    'url' => $event['request']->getUrl()
                ));
            $res->setHeader('content-type', Filter::replaceHeaderCharset($contentType));
            $bodyEntity->write($body);
        }
    }
}
