<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Date;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder(null, [
                'csrf_protection' => false,
                'method' => 'GET',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date test:',
                'widget' => 'single_text',
                'constraints' => [
                    new Date(),
                ],
                'attr' => [
                    'placeholder' => 'yyyy-mm-dd',
                ],
            ])
            ->getForm();

        $form->handleRequest($request);
        $date = $form->isValid() ? $form->get('date')->getData() : null;

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'date' => $date,
        ]);
    }
}
