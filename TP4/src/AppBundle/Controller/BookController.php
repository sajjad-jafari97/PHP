<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AppBundle\Entity\Book;


/**
 * @Route("/book")
 */

class BookController extends Controller
{
    /**
     * @Route("/index" , name="book_index")
     */
    public function indexAction( Request $request)
    {

       $books = $this->getDoctrine()->getRepository(Book::class)->findAll();

        $book = new Book();
        $form = $this->createFormBuilder($book)
        ->add('title', TextType::class)
        ->add('isbn', TextType::class)
        ->add('nbPages', NumberType::class)
        ->add('submit', SubmitType::class, array(
              'label' => 'Enregistrer',
        ))

        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
          $book = $form->getData();
          $em = $this->getDoctrine()->getManager();
          $em->persist($book);
          $em->flush();
          return $this->redirectToRoute('book_index');
        }


        return $this->render('AppBundle:Book:index.html.twig', array(
           'books' => $books,
           'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {




        return $this->render('AppBundle:Book:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete{id}" , name="book_delete")
     */
    public function deleteAction($id)
    {

        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute('book_index');

    }

    /**
     * @Route("/update{id}", name="book_update")
     */
    public function updateAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($id);


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

          $book->setTitle($request->request->get('title'));
          $book->setIsbn($request->request->get('isbn'));
          $book->setNbPages($request->request->get('nbPages'));
          $em->flush();
          return $this->redirectToRoute('book_update');
        };


        return $this->render('AppBundle:Book:update.html.twig', array(
          'book' => $book,
          //'form' => $form->createView(),

        ));
    }

}
