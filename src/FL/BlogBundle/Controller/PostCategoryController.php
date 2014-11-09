<?php

namespace FL\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostCategoryController extends Controller
{
    /**
     * @Route("/blog/categories/menu/{limit}", name="categories_menu")
     * @Template("FLBlogBundle:Category:menu_list.html.twig")
     */
    public function menuListAction($limit = null)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FLBlogBundle:PostCategory')->findBy(array(), array(), $limit);

        return $this->render(
            'FLBlogBundle:PostCategory:menu_list.html.twig',
            array('categories' => $categories)
        );
    }

}
