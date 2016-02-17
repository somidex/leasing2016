<?php

namespace Leasing\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LeasingCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
