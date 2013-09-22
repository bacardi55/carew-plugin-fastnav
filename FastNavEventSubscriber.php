<?php

namespace Carew\Plugin\FastNav;

use Carew\Event\Events;
use Carew\Document;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig_Environment;

class FastNavEventSubscriber implements EventSubscriberInterface
{
    protected $url_absolute;

    public function __construct($config)
    {
        $this->url_absolute = isset($config['site']['url_absolute']) ?
            $config['site']['url_absolute'] : '';
    }

    public function onDocuments($event)
    {
        $this->addFastNav($event->getSubject());
    }

    public static function getSubscribedEvents()
    {
        return array(
            Events::DOCUMENTS => array(
                array('onDocuments', 256),
            ),
        );
    }

    protected function addFastNav($documents)
    {
        $documents = array_filter($documents, function($document) {
            return ($document->getType() == Document::TYPE_POST);
        });

        $keys = array_keys($documents);
        sort($keys);

        $nbDocs = count($keys);
        for ($i = 0; $i < $nbDocs; ++$i) {
            $prev = $next = array('link' => null, 'title' => null);

            if (isset($keys[$i - 1])) {
                $prev = array(
                    'link' => $this->url_absolute
                        . '/' . $documents[$keys[$i - 1]]->getPath(),
                    'title' => $documents[$keys[$i - 1]]->getTitle(),
                );
            }
            if (isset($keys[$i + 1])) {
                $next = array(
                    'link' => $this->url_absolute
                        . '/' . $documents[$keys[$i + 1]]->getPath(),
                    'title' => $documents[$keys[$i + 1]]->getTitle(),
                );
            }

            $fastNav = array('next' => $next, 'prev' => $prev);

            $documents[$keys[$i]]->addMetadatas(
                array('fastNav' => $fastNav), true
            );
        }
    }
}

