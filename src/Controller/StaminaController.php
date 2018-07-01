<?php

namespace App\Controller;

use App\Entity\Message;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StaminaController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('stamina/index.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Make it a lifestyle, not a duty',
            'header_text' => 'Time to KILL some fat',

        ]);
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery()
    {
        return $this->render('stamina/gallery.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Gallery',
            'header_text' => 'Popular Photography',

        ]);
    }

    /**
     * @Route("/trainer", name="trainer")
     */
    public function trainer()
    {
        return $this->render('stamina/trainer.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Fitness Trainer',
            'header_text' => 'one who gets pleasure from inflicting
            pain on others',

        ]);
    }

    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricing()
    {
        return $this->render('stamina/pricing.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Pricing',
            'header_text' => 'The best price this month',

        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        return $this->render('stamina/blog.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Blog',
            'header_text' => 'Something about us',

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('stamina/contact.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Contact Us',
            'header_text' => '',

        ]);
    }

    /**
     * @Route("/contact2", name="contact2")
     */
    public function contact2(Request $request)
    {

        $message = new Message();

        $form = $this->createFormBuilder($message)->add('first_name', TextType::class,
            array('attr' => array('class' => 'form-control')))->add(
            'last_name', TextType::class, array('attr' => array('class' => 'form-control'))
        )->add('emaill', TextType::class, array('attr' => array('class' => 'form-control')))->add(
                'subject_message', TextType::class, array('attr' => array('class' => 'form-control'))
        )->add('message', TextType::class, array('attr' => array('class' => 'form-control')))->add(
                    'save', SubmitType::class, array('label' => 'Send message',
                        'attr' => array('class' => 'btn btn-primary mt-3')))->getForm();

        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message = $form->getData();

            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }


        return $this->render('stamina/contact2.html.twig', [
            'title_name' => 'StaminaController',
            'header_heading' => 'Contact Us',
            'header_text' => '',
            'form' => $form->createView(),

        ]);
    }

}
