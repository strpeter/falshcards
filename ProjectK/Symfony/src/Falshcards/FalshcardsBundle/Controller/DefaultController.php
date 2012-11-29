<?php

namespace Falshcards\FalshcardsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FalshcardsBundle:Default:index.html.twig', array('name' => $name));
    }
}
