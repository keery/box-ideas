<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Vote;
use AppBundle\Entity\Idea;

class AjaxController extends Controller
{
    public function upvoteAction(Idea $idea, Request $request)
    {
        
        if(isset($idea)) {
            $em = $this
                ->getDoctrine()
                ->getManager()
            ;

            $global_functions = $this->container->get('global_functions');
            $ip = $global_functions->getCurrentIp();
            
            if(!$vote = $em->getRepository('AppBundle:Vote')->findOneBy(['idea' => $idea->getId(), 'ipAdress' => $ip])) {
                $vote = new Vote();
                $vote->setIdea($idea);
                $vote->setIpAdress($ip);
                $em->persist($vote);
            }
            else $em->remove($vote);

            $em->flush();

            return new JsonResponse(true);            
        }
        else return new JsonResponse("Param idIdea required");
                
    }

    public function deleteAction(Idea $idea, Request $request)
    {
        if(isset($idea)) {
            
            $em = $this
                ->getDoctrine()
                ->getManager()
            ;

            $em->remove($idea);
            $em->flush();

            return new JsonResponse("cool");            
        }
        else return new JsonResponse("Error idea not found");
                
    }
}
