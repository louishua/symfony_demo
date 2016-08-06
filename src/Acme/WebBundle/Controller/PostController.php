<?php
/**
 * @Author: zhanghua <zhanghua8760@gmail.com>
 * @Date: 16-8-6
 * @version: 1.0
 */

namespace Acme\WebBundle\Controller;


use Acme\WebBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
        $post = new Post();
        $this->denyAccessUnlessGranted('view', $post);

        return $this->render('AcmeWebBundle:Post:index.html.twig');
    }
}