<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;


class MediaController extends Controller
{
    public function homeAction()
    {
        return $this->render('AdminBundle:Media:home.html.twig');
    }

    public function mediaArticleAction()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../../../web/uploads/actu/content');
        $empty = 0;
        foreach($finder as $file)
        {
            if($file->getRelativePathname()){
                $empty = 1;
            }
        }
        return $this->render('AdminBundle:Media:article.html.twig',array('empty'=> $empty,'images' => $finder));
    }

    public function mediaMiniatureAction()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../../../web/media/cache/actu_thumb/uploads/actu');
        $empty = 0;
        foreach($finder as $file)
        {
            if($file->getRelativePathname()){
                $empty = 1;
            }
        }
        return $this->render('AdminBundle:Media:miniature.html.twig',array('empty'=> $empty,'images' => $finder));
    }

    public function deleteAction($image)
    {
        $upload_dir = 'symfony_ml/web/uploads/actu/content/';
        $path = $_SERVER['DOCUMENT_ROOT'].$upload_dir;
        unlink($path.$image);
        return $this->redirect($this->generateUrl('admin_media'));
    }


}