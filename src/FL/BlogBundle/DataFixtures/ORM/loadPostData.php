<?php
namespace FL\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use FL\BlogBundle\Entity\Post;
use FL\BlogBundle\Entity\PostCategory;
use FL\BlogBundle\Entity\Image;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
  private $postsDatas = array(
    array(
      'name'  =>  'Ouverture du blog !',
      'slug'     =>  'ouverture-blog',
      'teaser'     =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed eleifend ante. In nec libero non quam mollis consequat eu nec tortor. Vivamus eu molestie mi. Sed bibendum vitae dui quis dignissim. Nullam nec eros mattis, viverra erat quis, commodo ligula. Curabitur magna orci, porttitor eget purus non, eleifend fringilla ipsum. Cras lobortis dignissim nisl, ac convallis magna tristique ac. Praesent id sodales nisl.',
      'content'     =>  '<p>Aenean nec augue egestas, scelerisque lacus eu, pretium leo. Nulla facilisi. Nulla ultrices nisi et quam lobortis, ac fermentum sapien ullamcorper. Phasellus iaculis risus ac dictum egestas. Nulla facilisi. Sed nec ante sit amet risus consectetur volutpat. Vivamus in pretium libero. Aenean aliquam sit amet mauris quis rutrum. Curabitur sit amet ligula a mauris auctor euismod.</p>

<p>Suspendisse lacinia lacinia faucibus. Cras ut eros eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut eleifend lectus sit amet turpis mollis luctus. Nam eu tempus elit. Fusce cursus venenatis magna, eu volutpat lacus iaculis id. Ut a sem in sapien sagittis sodales. Sed at vulputate purus. Integer a iaculis tellus. Sed tincidunt, eros eget faucibus mattis, quam libero tempor ligula, sed cursus mauris libero ut nibh. Suspendisse eu dolor nec libero consequat vehicula id laoreet velit. Curabitur velit sapien, ullamcorper eu dapibus vel, hendrerit eget dolor.</p>

<p>Pellentesque venenatis, metus non suscipit elementum, lectus libero cursus massa, sit amet ornare lorem massa euismod diam. Etiam adipiscing lorem in risus cursus aliquam. Proin tincidunt felis sed nulla tristique suscipit. Sed pellentesque magna quis elementum dapibus. Proin porttitor in dui vel aliquet. Etiam nunc ipsum, congue eget elit at, semper lacinia metus. Maecenas laoreet leo sed tortor imperdiet sollicitudin. Aenean neque mi, aliquam eu elementum in, tempus vitae massa. Vestibulum id tellus tortor. Pellentesque rhoncus odio justo, feugiat porta turpis convallis ac. Morbi egestas, purus eget accumsan porta, libero justo egestas enim, ac feugiat justo augue sit amet est.</p>

<p>Vestibulum lobortis nunc sollicitudin quam interdum, id mattis felis sodales. Suspendisse viverra sapien ipsum, et pretium metus convallis vel. Sed nec dolor vestibulum turpis iaculis pellentesque at et mauris. Morbi aliquam non diam eget placerat. Duis pulvinar est eu sem vestibulum, a ultricies arcu rutrum. Integer semper arcu vitae turpis varius, ac luctus ante blandit. Maecenas imperdiet viverra tortor sit amet tincidunt. Donec laoreet leo vel leo eleifend sagittis. Maecenas porttitor venenatis ante. Aliquam varius id est vel sagittis. Sed placerat mi in convallis consectetur.</p>',
      'author'     =>  'Florian',
      'published'     =>  true
    ),
  );

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    foreach($this->postsDatas as $postData) {
      $author = $manager->getRepository('FLUserBundle:User')->findOneByUsername($postData['author']);
      $category = $manager->getRepository('FLBlogBundle:PostCategory')->findOneBySlug('divers');

      $post = new Post();

      $post->setName($postData['name']);
      $post->setSlug($postData['slug']);
      $post->setCategory($category);
      $post->setTeaser($postData['teaser']);
      $post->setContent($postData['content']);
      $post->setDatePublish(new \DateTime());
      $post->setDateEdit(null);
      $post->setAuthor($author);
      $post->setPublished($postData['published']);

      $manager->persist($post);
    }

    $manager->flush();
  }

  /**
   * {@inheritDoc}
   */
  public function getOrder()
  {
      return 1;
  }
}
