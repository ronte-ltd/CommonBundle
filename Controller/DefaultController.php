<?php

namespace RonteLtd\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RonteLtdCommonBundle:Default:index.html.twig');
    }
}
