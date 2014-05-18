<?php

namespace FL\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/blog")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/blog/post/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
        return array();
    }
}
