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

    public function getLeftSideAds(int $page);

    public function getRightSideAds(int $page);

    public function getLeaderboardAds(int $page);

    public function getBelowFacebookAds(int $page);

    public function getBelowPopularPostAds(int $page);

    public function getStandardBannerAds(int $page, int $categoryId);

    public function getPopupAds(int $page);

    public function getBelowNavigationBarAds(int $page);

    public function getDetailAdsTop();

    public function getDetailAdsMiddle();

    public function getDetailAdsBottom();
}