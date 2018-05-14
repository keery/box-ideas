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
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MainController extends Controller
{
    public function indexAction(Request $request)
    {

        //Je vérifie si je possède le role admin
        $vars['isAdmin'] = $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN');

        $global_functions = $this->container->get('global_functions');

        // Liste des idées
        $t_ideas = $this->getDoctrine()->getRepository('AppBundle:Idea')->findAll();

        //Liste des idées que pourq lesquelles j'ai déjà voté
        $voted_ideas = [];
        foreach($t_ideas as $idea) {
            $id = $idea->getId();

            foreach($idea->getVotes() as $vote) {
                if($vote->getIpAdress() == $global_functions->getCurrentIp()) {
                    $voted_ideas[$id] = true;
                    break;
                }
            }
        }

        $vars['voted_ideas'] = json_encode($voted_ideas);

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

    //Serialize mes entités
    private function serializeData($data) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer(array($normalizer), array($encoder));
        return $serializer->serialize($data, 'json');
    }
}
