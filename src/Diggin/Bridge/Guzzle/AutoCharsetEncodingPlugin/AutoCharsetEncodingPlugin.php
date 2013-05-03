<?php
namespace Diggin\Bridge\Guzzle\AutoCharsetEncodingPlugin;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Diggin\Http\Charset\Filter;
use Diggin\Http\Charset\Front\UrlRegex;
use Diggin\Http\Charset\Front\DocumentConverter;

class AutoCharsetEncodingPlugin implements EventSubscriberInterface
{
    /**
     * @var DocumentConverter
     */
    protected $charset_front;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array('request.complete' => array('onRequestComplete', 255));
    }

    /**
     * {@inheritdoc}
     */
    public function onRequestComplete(Event $event)
    {
        if ($res = $event['request']->getResponse()) {
            $contentType = $res->getHeader('content-type', true);
            $redirect = $res->getHeader('Location');
            if (!empty($redirect) || !preg_match('#^text/html#i', $contentType)) {
                return;
            }
            $bodyEntity = $res->getBody(false);
            $body = $this->getCharsetFront()
                ->convert((string)$bodyEntity, array(
                    'content-type' => $contentType,
                    'url' => $event['request']->getUrl()
                ));
            $res->setHeader('content-type', Filter::replaceHeaderCharset($contentType));
            $bodyEntity->seek(0, SEEK_SET);
            $bodyEntity->write($body);
        }
    }

    /**
     * @return DocumentConverter
     */
    public function getCharsetFront()
    {
        if (!$this->charset_front) {
            $this->charset_front = new UrlRegex;
        }

        return $this->charset_front;
    }

    public function setCharsetFront(DocumentConverter $charset_front)
    {
        $this->charset_front = $charset_front;
        return $this;
    }
}
