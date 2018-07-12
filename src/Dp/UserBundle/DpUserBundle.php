<?php

namespace Dp\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DpUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
