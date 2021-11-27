<?php

namespace Botble\Advs\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface AdvsInterface extends RepositoryInterface
{

    /**
     * Get all galleries.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getDataSiteMap();

    /**
     * @param $limit
     */
    //public function getFeaturedGalleries($limit);
}