<?php
namespace FL\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FL\BlogBundle\Entity\PostCategory;

class LoadPostCategoryData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
   * Fonction to save
   */
  private $postCategoriesDatas = array(
    array(
      'name'  =>  'Coups de coeur',
      'slug'     =>  'coups-coeurs'
    ),
    array(
      'name'  =>  'Symfony2',
      'slug'     =>  'symfony2'
    ),
    array(
      'name'  =>  'Développement',
      'slug'     =>  'developpement'
    ),
    array(
      'name'  =>  'Perso',
      'slug'     =>  'perso'
    ),
    array(
      'name'  =>  'Divers',
      'slug'     =>  'divers'
    ),
    array(
      'name'  =>  'Projets',
      'slug'     =>  'projets'
    ),
  );

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    foreach($this->postCategoriesDatas as $postCategoryData) {
      $postCategory = new PostCategory();

      $postCategory->setName($postCategoryData['name']);
      $postCategory->setSlug($postCategoryData['slug']);

      $manager->persist($postCategory);
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
