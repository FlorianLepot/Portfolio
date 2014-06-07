<?php

namespace FL\FilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin/files")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="files")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $years = $em->getRepository('FLFilesBundle:Year')->findAll();

        return array(
            'years' => $years
        );
    }

    /**
     * @Route("/year/{slug}", name="files_year")
     * @Template()
     */
    public function yearAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $year = $em->getRepository('FLFilesBundle:Year')->findOneBySlug($slug);
        $subjects = $em->getRepository('FLFilesBundle:Subject')->findByYear($year);

        return array(
            'year' => $year,
            'subjects' => $subjects
        );
    }

    /**
     * @Route("/subject/{slug}", name="files_year_subject")
     * @Template()
     */
    public function subjectAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('FLFilesBundle:Subject')->findOneBySlug($slug);

        $files = $this->listFolderFiles(__DIR__.'/../Resources/public/files/', $subject->getYear()->getSlug().'/'.$subject->getSlug());

        return array(
            'subject' => $subject,
            'files' => $files
        );
    }

    function listFolderFiles($rootPath, $dir){
        $ffs = scandir($rootPath.$dir);

        $files = array();
        $i = 0;
        foreach($ffs as $ff){
            if($ff != '.' && $ff != '..'){
                $files[$i]['name'] = $ff;
                $files[$i]['path'] = $dir.'/'.$ff;
                if(is_dir($dir.'/'.$ff)) {
                    $files[$i]['files'] =  $this->listFolderFiles($rootPath, $dir.'/'.$ff);
                }
            }

            $i++;
        }

        return $files;
    }

    /**
     * @Route("/subject/{slug}/{category}", name="files_year_subject_category")
     * @Template("FLFilesBundle:Default:subject_category.html.twig")
     */
    public function subjectCategoryAction($slug, $category)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('FLFilesBundle:Subject')->findOneBySlug($slug);

        $files = $this->listFolderFiles(__DIR__.'/../Resources/public/files/', $subject->getYear()->getSlug().'/'.$subject->getSlug().'/'.$category);

        return array(
            'subject' => $subject,
            'files' => $files
        );
    }
}
