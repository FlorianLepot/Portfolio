<?php
namespace FL\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Finder\Finder;

use FL\BlogBundle\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
    * @var ContainerInterface
    */
    private $container;

    /**
    * {@inheritDoc}
    */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
    * {@inheritDoc}
    */
    public function load(ObjectManager $manager)
    {
        $images = array();

        $finder = new Finder();
        $folderPath = __DIR__ . '/../media';
        $finder->files()->in($folderPath);

        foreach ($finder as $file) {
            $filePath = 'uploads/gallery/' . $file->getRelativePathname();
            $image = new Image();
            $image->setName($file->getRelativePathname());
            $image->setPath($filePath);
            $image->setDateUpload(new \DateTime());
            $manager->persist($image);
        }

        $manager->flush();
    }

    /**
    * {@inheritDoc}
    */
    public function getOrder()
    {
    return 0;
    }
}
