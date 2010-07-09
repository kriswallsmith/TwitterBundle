<?php

namespace Bundle\Kris\TwitterBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Loader\LoaderExtension;
use Symfony\Components\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Components\DependencyInjection\BuilderConfiguration;
use Symfony\Components\DependencyInjection\ContainerInterface;

class TwitterExtension extends LoaderExtension
{
    protected $resources = array(
        'twitter' => 'twitter.xml',
    );

    public function apiLoad($config, BuilderConfiguration $configuration)
    {
        if (!$configuration->hasDefinition('kris.twitter')) {
            $loader = new XmlFileLoader(__DIR__.'/../Resources/config');
            $configuration->merge($loader->load($this->resources['twitter']));
        }

        if (isset($config['alias'])) {
            $configuration->setAlias($config['alias'], 'kris.twitter');
        }

        foreach (array('consumer_key', 'consumer_secret') as $attribute) {
            if (isset($config[$attribute])) {
                $configuration->setParameter('kris.twitter.'.$attribute, $config[$attribute]);
            }
        }

        return $configuration;
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
