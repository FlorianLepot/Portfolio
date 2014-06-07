<?php
namespace FL\FilesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FL\FilesBundle\Entity\Year;

class LoadYearData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
  private $yearsDatas = array(
    array(
      'name'  =>  'L1',
      'slug'     =>  'L1'
    ),
    array(
      'name'  =>  'L2',
      'slug'     =>  'L2'
    ),
    array(
      'name'  =>  'L3',
      'slug'     =>  'L3'
    ),
    array(
      'name'  =>  'M1 - IN',
      'slug'     =>  'M1'
    ),
    array(
      'name'  =>  'M2 - IN IRV',
      'slug'     =>  'M2'
    ),
  );

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    foreach($this->yearsDatas as $yearDatas) {
      $year = new Year($yearDatas['name'], $yearDatas['slug']);

      $manager->persist($year);
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
