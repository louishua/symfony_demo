<?php

namespace Acme\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashBoardController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeWebBundle:DashBoard:index.html.twig');
    }
}