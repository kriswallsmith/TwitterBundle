<?php

namespace Bundle\Kris\TwitterBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Extension\Extension;
use Symfony\Components\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Components\DependencyInjection\ContainerBuilder;

class TwitterExtension extends Extension
{
    protected $resources = array(
        'twitter' => 'twitter.xml',
    );

    public function apiLoad($config, ContainerBuilder $container)
    {
        if (!$container->hasDefinition('kris.twitter')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['twitter']);
        }

        if (isset($config['alias'])) {
            $container->setAlias($config['alias'], 'kris.twitter');
        }

        foreach (array('consumer_key', 'consumer_secret') as $attribute) {
            if (isset($config[$attribute])) {
                $container->setParameter('kris.twitter.'.$attribute, $config[$attribute]);
            }
        }
    }

    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://kriswallsmith.net/schema/dic/twitter';
    }

    public function getAlias()
    {
        return 'twitter';
    }
}
