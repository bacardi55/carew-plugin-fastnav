<?php

namespace Carew\Plugin\FastNav;

use Carew\Event\Events;
use Carew\Document;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig_Environment;

class FastNavEventSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
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
        $keys = array_keys($documents);
        sort($keys);

        $nbDocs = count($keys);
        for ($i = 0; $i < $nbDocs; ++$i) {
          $prev = $next = array('link' => NULL, 'title' => NULL);

          if (isset($keys[$i - 1])) {
            $prev = array(
              'link' => '/' . $keys[$i - 1],
              'title' => $documents[$keys[$i - 1]]->getTitle(),
            );
          }
          if (isset($keys[$i + 1])) {
            $next = array(
              'link' => '/' . $keys[$i + 1],
              'title' => $documents[$keys[$i + 1]]->getTitle(),
            );
          }

          $fastNav = array('next' => $next, 'prev' => $prev);
          $documents[$keys[$i]]->setMetadatas(array('fastNav' => $fastNav), true);
        }
    }
}

