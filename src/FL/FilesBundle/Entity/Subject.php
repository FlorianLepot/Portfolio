<?php

namespace FL\FilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Subject
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FL\FilesBundle\Entity\SubjectRepository")
 */
class Subject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="FL\FilesBundle\Entity\Year")
     * @ORM\JoinColumn(nullable=false)
     */
    private $year;


    public function __construct($name, $slug, $year) {
        $fs = new Filesystem();

        $this->name = $name;
        $this->slug = $slug;
        $this->year = $year;

        try {
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug);
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug.'/Cours');
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug.'/TD');
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug.'/TP');
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug.'/Projets');
            $fs->mkdir(__DIR__.'/../Resources/public/files/'.$this->year->getSlug().'/'.$this->slug.'/Copies');
        } catch (IOException $e) {
            echo "Impossible de créer le répertoire";
        }
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Subject
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set year
     *
     * @param \FL\FilesBundle\Entity\Year $year
     * @return Subject
     */
    public function setYear(\FL\FilesBundle\Entity\Year $year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \FL\FilesBundle\Entity\Year
     */
    public function getYear()
    {
        return $this->year;
    }
}
