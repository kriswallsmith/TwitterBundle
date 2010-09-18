<?php

namespace Bundle\Kris\TwitterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension;

class KrisTwitterBundle extends Bundle
{
    public function buildContainer(ParameterBagInterface $parameterBag)
    {
        ContainerBuilder::registerExtension(new TwitterExtension());
    }
}
