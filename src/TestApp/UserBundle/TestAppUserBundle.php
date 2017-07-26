<?php

namespace TestApp\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TestAppUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
