<?php

namespace FL\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/blog/posts")
 */
class PostController extends Controller
{
    /**
     * @Route("/menu/{limit}", name="posts_menu")
     * @Template("FLBlogBundle::menu_list.html.twig")
     */
    public function menuListAction($limit = null)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('FLBlogBundle:Post')->findBy(array(), array(), $limit);

        return $this->render(
            'FLBlogBundle:Post:menu_list.html.twig',
            array('posts' => $posts)
        );
    }

    /**
     * @Route("/{id}", name="posts_view")
     * @Template()
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('FLBlogBundle:Post')->find($id);

        return array(
            'post' => $post
        );
    }

    /**
     * @Route("/{id}/view", name="posts_view_content")
     * @Template("FLBlogBundle:Post:view_content.html.twig")
     */
    public function viewContentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('FLBlogBundle:Post')->find($id);

        return array(
            'post' => $post
        );
    }

}
