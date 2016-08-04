<?php
/**
 * @Author: zhanghua <zhanghua8760@gmail.com>
 * @Date: 16-8-4
 * @version: 1.0
 */

namespace Acme\UserBundle\Controller;

use Acme\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function createAction(Request $request) {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('add', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $form->getData();

            // Encoding password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(), $user->getSalt());
            $entity->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            // perform some action, such as saving the task to the database
            return $this->redirect($this->generateUrl('_welcome'));
        }

        return $this->render('AcmeUserBundle:User:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}