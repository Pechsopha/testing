<?php

namespace Botble\Advs\Listeners;

use SiteMapManager;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;

class RenderingSiteMapListener
{
    /**
     * @var GalleryInterface
     */
    protected $advsRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param GalleryInterface $galleryRepository
     */
    public function __construct(AdvsInterface $advsRepository)
    {
        $this->advsRepository = $advsRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        SiteMapManager::add(route('public.galleries'), '2018-10-10 00:00', '0.8', 'weekly');

        $advs = $this->advsRepository->getDataSiteMap();

        foreach ($advs as $adv) {
            SiteMapManager::add($adv->url, $advs->updated_at, '0.8', 'daily');
        }
    }
}