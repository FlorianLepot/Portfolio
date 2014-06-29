<?php

namespace FL\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
    	return array();
    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $title = $request->request->get('title');
            $message = $request->request->get('message');

            $message = \Swift_Message::newInstance()
                ->setSubject('[Portfolio] ' . $title)
                ->setFrom($email)
                ->setTo('florian.lepot@gmail.com')
                ->setContentType('text/html')
                ->setBody($this->renderView('FLPublicBundle:Mail:contact.html.twig', array('name' => $name, 'message' => $message)));
            ;
            $this->get('mailer')->send($message);

            return array('message' => '<i class="fa fa-ok"></i> Votre message a bien été envoyé, vous aurez une réponse très prochainement !');
        }

    	return array();
    }

}
