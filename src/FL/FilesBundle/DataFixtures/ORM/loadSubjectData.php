<?php
namespace FL\FilesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FL\FilesBundle\Entity\Subject;

class LoadSubjectData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
  private $subjectsData = array(
    array(
      'name'  =>  'Algèbre Linéaire',
      'slug'     =>  'algebre-lineaire',
      'year' => 'L1'
    ),
    array(
      'name'  =>  'Anglais',
      'slug'     =>  'anglais',
      'year' => 'L1'
    ),
    array(
      'name'  =>  'Atome à la puce',
      'slug'     =>  'atome-a-la-puce',
      'year' => 'L1'
    ),
    array(
      'name'  =>  'Analyse de données',
      'slug'     =>  'analyse-de-donnees',
      'year' => 'L2'
    ),
    array(
      'name'  =>  'Architecture des ordinateurs',
      'slug'     =>  'architecture-des-ordinateurs',
      'year' => 'L2'
    ),
    array(
      'name'  =>  'Champs magnétiques',
      'slug'     =>  'champs-magnetiques',
      'year' => 'L2'
    ),
    array(
      'name'  =>  'Aide à la décision',
      'slug'     =>  'aide-a-la-decision',
      'year' => 'L3'
    ),
    array(
      'name'  =>  'Analyse financière',
      'slug'     =>  'analyse-financiere',
      'year' => 'L3'
    )
  );

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    foreach($this->subjectsData as $subjectDatas) {
      $year = $manager->getRepository('FLFilesBundle:Year')->findOneBySlug($subjectDatas['year']);

      $subject = new Subject($subjectDatas['name'], $subjectDatas['slug'], $year);


      $manager->persist($subject);
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
