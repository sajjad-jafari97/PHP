<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AppBundle\Entity\Author;


/**
 * @Route("/author")
 */

class AuthorController extends Controller
{
    /**
     * @Route("/index" , name="author_index")
     */
    public function indexAction( Request $request)
    {

       $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();

        $author = new Author();
        $form = $this->createFormBuilder($author)
        ->add('firstname', TextType::class)
        ->add('lastname', TextType::class)
        ->add('origin', TextType::class)
        ->add('submit', SubmitType::class, array(
              'label' => 'Enregistrer',
        ))

        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
          $author = $form->getData();
          $em = $this->getDoctrine()->getManager();
          $em->persist($author);
          $em->flush();
          return $this->redirectToRoute('author_index');
        }


        return $this->render('AppBundle:Author:index.html.twig', array(
           'author' => $authors,
           'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {




        return $this->render('AppBundle:Author:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete{id}" , name="author_delete")
     */
    public function deleteAction($id)
    {

        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('author_index');

    }

    /**
     * @Route("/update{id}", name="author_update")
     */
    public function updateAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $author = $em->getRepository(Author::class)->find($id);


      //   $form = $this->createFormBuilder()
      //   ->add('title', TextType::class, array('data'=>$book->getTitle()))
      //    ->add('isbn', TextType::class, array('data'=>$book->getIsbn()))
      //    ->add('nbPages', NumberType::class, array('data'=>$book->getNbPages()))
      //   ->add('submit', SubmitType::class, array(
      //        'label' => 'Enregistrer',
      // ))
      //   ->getForm();
        //$form->handleRequest($request);

        if ($request->getMethod() == 'POST'){

          $author->setFirstname($request->request->get('firstname'));
          $author->setLastname($request->request->get('lastname'));
          $author->setOrigin($request->request->get('origin'));
          $em->flush();
          return $this->redirectToRoute('author_index');
        };


        return $this->render('AppBundle:Author:update.html.twig', array(
          'author' => $author,
          //'form' => $form->createView(),

        ));
    }

}
