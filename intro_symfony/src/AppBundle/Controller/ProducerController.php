<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Producer;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/producer")
 */
class ProducerController extends Controller
{
    /**
     * @Route("/index" , name="producer_index")
     */
    public function indexAction()
    {
        $producers = $this->getDoctrine()->getRepository(Producer::class)->findAll();
        return $this->render('AppBundle:Producer:index.html.twig', array(
            'producers' => $producers,
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {   // création d'un objet vide
        $producer = new Producer();
        // la méthod createFormBuilder permet de créer un formulaire
        // en pur PHP OO (pas de balise HTML)
        $form = $this->createFormBuilder($producer)
        ->add('name', TextType::class)
        ->add('sumbit', SubmitType::class, array(
          'label' => 'Enregister',
        ))
        ->getForm();

          // handleRequest() établit la connexion entre
          // l'objet $form et l'objet $request

          $form->handleRequest($request);


        // méthode permettant de savoir si le formulaire a été envoyé
        // équivalent de $request->getMethod() lorsqu'on utilise
        //l'objet Request $request

        if($form->isSubmitted()){
          //hydratation automatique grâce à getData()
          $producer = $form->getData();

          //enregistement en bas de données
          $em = $this->getDoctrine()->getManager();
          $em->persist($producer);
          $em->flush();
        return $this->redirectToRoute('producer_index');
        }


        return $this->render('AppBundle:Producer:add.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Producer:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Producer:delete.html.twig', array(
            // ...
        ));
    }

}
