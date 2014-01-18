<?php

namespace Sicc\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SiccUserBundle extends Bundle
{
    public function getParent(){
        return "FOSUserBundle";
    }
}
