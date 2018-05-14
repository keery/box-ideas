<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
  public function connexionAction(Request $request)
	{
	  if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	    return $this->redirectToRoute('bi_main_admin');
	  }

	  $authenticationUtils = $this->get('security.authentication_utils');

	  return $this->render('AppBundle:Security:login.html.twig', array(
	    'error' => $authenticationUtils->getLastAuthenticationError()
	  ));
	}
}
