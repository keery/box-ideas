<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\IdeaType;
use AppBundle\Entity\Idea;


class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        $idea = new Idea();
        $form = $this->get('form.factory')->create(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idea);
            $em->flush();

            $request->getSession()->getFlashBag()->set('valid', 'New idea published');
            return $this->redirectToRoute('bi_main');            
        }
        $vars['form'] = $form->createView();
        return $this->render('AppBundle:App:index.html.twig', $vars);
    }
}
