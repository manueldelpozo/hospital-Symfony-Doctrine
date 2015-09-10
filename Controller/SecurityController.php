<?php
// Acme\HelloBundle\Controller\SecurityController;
namespace Acme\HelloBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM;
use Acme\HelloBundle\Entity\User;



class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
		//$user = $this->getDoctrine()->getRepository('AcmeHelloBundle:User')->find($id);

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'AcmeHelloBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
				//'user' 			=> $user
            )
        );
			
    }
	

	

    public function dumpStringAction()
    {
      return $this->render('AcmeHelloBundle:Default:dumpString.html.twig', array());
    }
	
	#añadir usuario /addUser
	public function addUserAction()
    {
      $user = new User();
      $user->setUsername("usuario");
      $user->setSalt(md5(uniqid()));
      $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
      $user->setPassword($encoder->encodePassword('password', $user->getSalt()));
      $user->setEmail("usuario@mail.com");

	  $em = $this->getDoctrine()->getEntityManager();
      $em->persist($user);

       $em->flush();
	  return new Response( "Creado");
    }
	
	public function testAction()
    {
      return new Response( "Has entrado en zona segura" );
    }
}
