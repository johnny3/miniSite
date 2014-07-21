<?php

namespace John\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JohnUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
