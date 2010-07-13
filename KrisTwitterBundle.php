<?php

namespace Bundle\Kris\TwitterBundle;

use Symfony\Framework\Bundle\Bundle;
use Symfony\Components\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Components\DependencyInjection\Loader\Loader;
use Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension;

class KrisTwitterBundle extends Bundle
{
    public function buildContainer(ParameterBagInterface $parameterBag)
    {
        Loader::registerExtension(new TwitterExtension());
    }
}
