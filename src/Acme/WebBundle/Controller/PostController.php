<?php
/**
 * @Author: zhanghua <zhanghua8760@gmail.com>
 * @Date: 16-8-6
 * @version: 1.0
 */

namespace Acme\WebBundle\Controller;


use Acme\WebBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\WebBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class PostController extends Controller
{
    public function indexAction()
    {
        $post = new Post();
        $this->denyAccessUnlessGranted('view', $post);

        return $this->render('AcmeWebBundle:Post:index.html.twig');
    }

    /**
     *
     */
    public function createAction()
    {

        $comment = new Comment();
        $comment->setContent('content');

        // ... setup $form, and submit data

//        if ($form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();

        // creating the ACL
        $aclProvider = $this->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($comment);
        $acl = $aclProvider->createAcl($objectIdentity);

        // retrieving the security identity of the currently logged-in user
        $tokenStorage = $this->get('security.token_storage');
        $user = $tokenStorage->getToken()->getUser();
        $securityIdentity = UserSecurityIdentity::fromAccount($user);

        // grant owner access
        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
        $aclProvider->updateAcl($acl);
        return $this->render('AcmeWebBundle:Post:create.html.twig');
//    }
    }

    public function editAction(Comment $comment)
    {
        $authorizationChecker = $this->get('security.authorization_checker');

        // check for edit access
        if (false === $authorizationChecker->isGranted('EDIT', $comment)) {
            throw new AccessDeniedException();
        }
        return $this->render('AcmeWebBundle:Post:edit.html.twig',['comment'=>$comment]);
    }
}