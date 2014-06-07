<?php

namespace FL\BlogBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use FL\BlogBundle\Entity\Image;
use FL\BlogBundle\Entity\Post;

class UploadListener
{
    private $container;

    public function __construct($doctrine, ContainerInterface $container)
    {
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $file = $event->getFile();
        $eventRequest = $event->getRequest();
        $request = $this->container->get('request');
        $em = $this->doctrine->getManager();

        $image = new Image();
        $image->setName($request->files->get('file')->getClientOriginalName());
        $image->setPath($file->getBasename());
        $image->setDateUpload(new \DateTime());

        $em->persist($image);
        $em->flush();
    }
}
?>