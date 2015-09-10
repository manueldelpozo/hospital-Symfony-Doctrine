<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\HelloBundle\Entity\Estudiante;
use Acme\HelloBundle\Entity\Product;
use Acme\HelloBundle\Form\ProductType;
use Acme\HelloBundle\Entity\User;



class DefaultController extends Controller
{	
	//para herencias
    public function crearEstudianteAction($nombre, $curso)
    {
	$estudiante = new Estudiante();
    $estudiante->setName($nombre);
    $estudiante->setCurso($curso);
 
    $em = $this->getDoctrine()->getManager();
    $em->persist($estudiante);
    $em->flush();
 
    return new Response('Created product id '.$estudiante->getId());
    }
	
	//para formulario
	public function formAction( Request $request)
    {
       
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product );
       
        $form->handleRequest( $request );

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
         
            return $this->redirect($this->generateUrl('acme_insertado'));
        }
        else
            return $this->render('AcmeHelloBundle:Default:form3.html.twig', array('form' => $form->createView(),));
    }
	
    public function insertadoAction()
    {
        return new Response( "El producto ha sido insertado" );
    }
	
	//para la plantilla hospital
	public function hospitalAction()
	{
		return $this->render('AcmeHelloBundle:Default:prueba.html.twig');
	}
	public function hospitalBackendAction()
	{
		//$user = $this->getDoctrine()->getRepository('AcmeHelloBundle:User')->find($last_username);
		return $this->render('AcmeHelloBundle:Default:pruebaBackend.html.twig');
	}
	public function medicoAction()
	{
		$medicos = $this->getDoctrine()->getRepository('AcmeHelloBundle:Medico')->findAll();
		return $this->render('AcmeHelloBundle:Default:medico.html.twig', array('medicos' => $medicos));
	}
	public function datosMedicosAction($id)
	{
		/*
		$em = $this->getDoctrine()->getManager();
		$medico = $em->getRepository('AcmeHelloBundle:Medico')->find($id);
		$query = $em->createQuery("SELECT e FROM AcmeHelloBundle:Medico m INNER JOIN AcmeHelloBundle:Especialidad e WHERE m.id = :id" );
		$query->setParameter('id', $id);
		$especialidades = $query->getResult();
		return $this->render('AcmeHelloBundle:Default:datosMedicos.html.twig', array('medico' => $medico, 'especialidades' => $especialidades) );
		*/
		$medico = $this->getDoctrine()->getRepository('AcmeHelloBundle:Medico')->find($id);
		return $this->render('AcmeHelloBundle:Default:datosMedicos.html.twig', array('medico' => $medico));
	}
	
	public function listaPromocionesAction()
	{
		$promociones = $this->getDoctrine()->getRepository('AcmeHelloBundle:Product')->findAll();
		return $this->render('AcmeHelloBundle:Default:listaPromociones.html.twig', array('promociones' => $promociones));
	}
	
	public function listaPromociones2Action()
	{
		$promociones = $this->getDoctrine()->getRepository('AcmeHelloBundle:Product')->findAll();
		return $this->render('AcmeHelloBundle:Default:listaPromociones2.html.twig', array('promociones' => $promociones));
	}
	
	public function promocionAction($id)
	{
		$promocion = $this->getDoctrine()->getRepository('AcmeHelloBundle:Product')->find($id);
		return $this->render('AcmeHelloBundle:Default:promocion.html.twig', array('promocion' => $promocion));
	}
	
	public function especialidadAction()
	{
		$especialidades = $this->getDoctrine()->getRepository('AcmeHelloBundle:Especialidad')->findAll();
		return $this->render('AcmeHelloBundle:Default:especialidad.html.twig', array('especialidades' => $especialidades));
	}
	public function datosEspecialidadesAction($id)
	{
		/*
		$em = $this->getDoctrine()->getManager();
		$especialidad = $em->getRepository('AcmeHelloBundle:Especialidad')->find($id);
		$query = $em->createQuery("SELECT m FROM AcmeHelloBundle:Medico m INNER JOIN AcmeHelloBundle:Especialidad e WHERE e.id = :id" );
		$query->setParameter('id', $id);
		$medicos = $query->getResult();
		return $this->render('AcmeHelloBundle:Default:datosMedicos.html.twig', array('especialidad' => $especialidad, 'medicos' => $medicos));
		*/
		$especialidad = $this->getDoctrine()->getRepository('AcmeHelloBundle:Especialidad')->find($id);
		return $this->render('AcmeHelloBundle:Default:datosEspecialidades.html.twig', array('especialidad' => $especialidad));
	}

	
}