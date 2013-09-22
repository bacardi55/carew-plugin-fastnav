<?php

namespace Carew\Plugin\FastNav;

use Carew\ExtensionInterface;
use Carew\Carew;

class FastNavExtension implements ExtensionInterface
{
    public function register(Carew $carew)
    {
        $container = $carew->getContainer();
        $eventDispatcher = $carew->getEventDispatcher()
            ->addSubscriber(new FastNavEventSubscriber($container['config']));
    }
}
