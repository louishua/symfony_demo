<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 16-8-1
 * Time: 上午1:19
 */

namespace Acme\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegisterController extends BaseController
{
    public function registerAction()
    {echo 2;exit;
        $response = parent::registerAction();

        // ... do custom stuff
        return $response;
    }
}