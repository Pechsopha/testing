<?php

namespace Theme\LaraMag\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Theme\Http\Controllers\PublicController;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;

class LaraMagController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex(BaseHttpResponse $response)
    {
        $allAds = app(AdvsInterface::class)->getAll();
        session(['all_ads' => $allAds]);
        return parent::getIndex($response);
    }

    /**
     * {@inheritDoc}
     */
    public function getView(BaseHttpResponse $response, $key = null)
    {
        $allAds = app(AdvsInterface::class)->getAll();
        session(['all_ads' => $allAds]);
        return parent::getView($response, $key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }
}
