<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Vote;

class AjaxController extends Controller
{
    public function upvoteAction(Request $request)
    {
        
        $data = json_decode(file_get_contents('php://input'));
        
        if(isset($data->idIdea)) {
            
            $em = $this
                ->getDoctrine()
                ->getManager()
            ;

            $global_functions = $this->container->get('global_functions');
            $ip = $global_functions->getCurrentIp();
            
            if(!$vote = $em->getRepository('AppBundle:Vote')->findOneBy(['idea' => $data->idIdea, 'ipAdress' => $ip])) {
                $idea = $em->getRepository('AppBundle:Idea')->findOneById($data->idIdea);
                $vote = new Vote();
                $vote->setIdea($idea);
                $vote->setIpAdress($ip);
                $em->persist($vote);
            }
            else $em->remove($vote);

            $em->flush();

            return new JsonResponse("Param idIdea required");            
        }
        else return new JsonResponse("Param idIdea required");
                
    }
}
