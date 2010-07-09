<?php

namespace Bundle\Kris\TwitterBundle;

use Symfony\Foundation\Bundle\Bundle;
use Symfony\Components\DependencyInjection\ContainerInterface;
use Symfony\Components\DependencyInjection\Loader\Loader;
use Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension;

class KrisTwitterBundle extends Bundle
{
    public function buildContainer(ContainerInterface $container)
    {
        Loader::registerExtension(new TwitterExtension());
    }
}
