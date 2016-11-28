<?php

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

$app->get('/form', function (Request $request) use ($app) {
    // some default data for when the form is displayed the first time
    $data = array(
        'name' => 'Your name',
        'email' => 'Your email',
    );

    $form = $app['form.factory']->createBuilder(FormType::class, $data)
        ->add('name')
        ->add('email')
        ->add('billing_plan', ChoiceType::class, array(
            'choices' => array(1 => 'free', 2 => 'small_business', 3 => 'corporate'),
            'expanded' => true,
        ))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        // do something with the data

        // redirect somewhere
        return $app->redirect('...');
    }

    // display the form
    return $app['twig']->render('uploadForm.twig', array('form' => $form->createView()));
});


$app->get('/', function($name) use($app) { 
    return 'Hello World !'; 
}); 