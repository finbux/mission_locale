<?php
namespace Mission_Locale\AdminBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Mission_locale\AdminBundle\Entity\Media;

class CacheImageListener
{
    protected $cacheManager;

    public function __construct($cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Media) {
            // clear cache of thumbnail
            $this->cacheManager->remove($entity->getUploadRootDir());
        }
    }

// when delete entity so remove all thumbnails related
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Media) {

            $this->cacheManager->remove($entity->getAbsolutePath());
        }
    }
}