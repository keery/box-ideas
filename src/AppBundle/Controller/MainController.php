<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:App:index.html.twig');
    
        return new Response($content);
    }
}
