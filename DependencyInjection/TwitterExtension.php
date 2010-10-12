<?php

namespace Bundle\Kris\TwitterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwitterExtension extends Extension
{
    protected $resources = array(
        'twitter' => 'twitter.xml',
    );

    public function apiLoad($config, ContainerBuilder $container)
    {
        if (!$container->hasDefinition('kris.twitter')) {
            $this->loadDefaults($container);
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

    /**
     * @codeCoverageIgnore
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'http://kriswallsmith.net/schema/dic/twitter';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'twitter';
    }

    /**
     * @codeCoverageIgnore
     */
    protected function loadDefaults($container)
    {
        $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load($this->resources['twitter']);
    }
}
