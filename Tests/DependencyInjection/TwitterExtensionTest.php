<?php

namespace Bundle\Kris\TwitterBundle\Tests\DependencyInjection;

use Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension;

class TwitterExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension::apiLoad
     */
    public function testApiLoadLoadsDefaults()
    {
        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerBuilder');
        $container
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('kris.twitter')
            ->will($this->returnValue(false));

        $extension = $this->getMockBuilder('Bundle\\Kris\\TwitterBundle\\DependencyInjection\\TwitterExtension')
            ->setMethods(array('loadDefaults'))
            ->getMock();
        $extension
            ->expects($this->once())
            ->method('loadDefaults')
            ->with($container);

        $extension->apiLoad(array(), $container);
    }

    /**
     * @covers Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension::apiLoad
     */
    public function testApiLoadDoesNotReloadDefaults()
    {
        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerBuilder');
        $container
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('kris.twitter')
            ->will($this->returnValue(true));

        $extension = $this->getMockBuilder('Bundle\\Kris\\TwitterBundle\\DependencyInjection\\TwitterExtension')
            ->setMethods(array('loadDefaults'))
            ->getMock();
        $extension
            ->expects($this->never())
            ->method('loadDefaults');

        $extension->apiLoad(array(), $container);
    }

    /**
     * @covers Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension::apiLoad
     */
    public function testApiLoadSetsAlias()
    {
        $alias = 'foo';

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerBuilder');
        $container
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('kris.twitter')
            ->will($this->returnValue(true));
        $container
            ->expects($this->once())
            ->method('setAlias')
            ->with($alias, 'kris.twitter');

        $extension = new TwitterExtension();
        $extension->apiLoad(array('alias' => $alias), $container);
    }

    /**
     * @covers Bundle\Kris\TwitterBundle\DependencyInjection\TwitterExtension::apiLoad
     * @dataProvider parameterNames
     */
    public function testApiLoadSetParameters($name)
    {
        $value = 'foo';

        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerBuilder');
        $container
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('kris.twitter')
            ->will($this->returnValue(true));
        $container
            ->expects($this->once())
            ->method('setParameter')
            ->with('kris.twitter.'.$name, $value);

        $extension = new TwitterExtension();
        $extension->apiLoad(array($name => $value), $container);
    }

    public function parameterNames()
    {
        return array(
            array('consumer_key'),
            array('consumer_secret'),
        );
    }
}
