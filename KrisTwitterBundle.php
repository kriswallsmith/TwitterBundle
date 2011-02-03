<?php

namespace Bundle\Kris\TwitterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KrisTwitterBundle extends Bundle
{
    /**
    * {@inheritdoc}
    */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
    * {@inheritdoc}
    */
    public function getPath()
    {
        return strtr(__DIR__, '\\', '/');
    }
}
