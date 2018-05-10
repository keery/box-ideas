<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\IdeaType;


class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->get('form.factory')->create(IdeaType::class);
        $vars['form'] = $form->createView();
        return $this->render('AppBundle:App:index.html.twig', $vars);
    }
}
