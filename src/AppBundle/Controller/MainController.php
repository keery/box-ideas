<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\IdeaType;
use AppBundle\Entity\Idea;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class MainController extends Controller
{
    public function indexAction(Request $request)
    {
    //     if (getenv('HTTP_CLIENT_IP'))
    //     $ipaddress = getenv('HTTP_CLIENT_IP');
    // else if(getenv('HTTP_X_FORWARDED_FOR'))
    //     $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    // else if(getenv('HTTP_X_FORWARDED'))
    //     $ipaddress = getenv('HTTP_X_FORWARDED');
    // else if(getenv('HTTP_FORWARDED_FOR'))
    //     $ipaddress = getenv('HTTP_FORWARDED_FOR');
    // else if(getenv('HTTP_FORWARDED'))
    //     $ipaddress = getenv('HTTP_FORWARDED');
    // else if(getenv('REMOTE_ADDR'))
    //     $ipaddress = getenv('REMOTE_ADDR');
    // else
    //     $ipaddress = 'UNKNOWN';
    //     var_dump($ipaddress);

        // Liste des idées
        $t_ideas = $this->getDoctrine()->getRepository('AppBundle:Idea')->findAll();
        
        //Serialization des objects pour les passer à mon component react
        $vars['ideas'] = $this->serializeData($t_ideas);
        

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

    private function serializeData($data, $type = "json") {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($data, $type);
    }
}
