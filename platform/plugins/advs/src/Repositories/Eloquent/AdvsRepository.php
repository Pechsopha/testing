<?php

namespace Botble\Advs\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;
use Carbon\Carbon;

class AdvsRepository extends RepositoriesAbstract implements AdvsInterface
{

    /**
     * {@inheritDoc}
     */
    public function getAll()
    {
        $data = $this->model
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->orderBy('advs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->select('advs.*')
            ->orderBy('advs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getLeftSideAds(int $page) 
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 1) // 1 = left side
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getRightSideAds(int $page) 
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 2) // 2 = right side
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getLeaderboardAds(int $page)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 3) // 3 = leaderboard
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getBelowFacebookAds(int $page)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 4) // 4 = ads below facebook page
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getBelowPopularPostAds(int $page)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 5) // 5 = ads below popular post
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getStandardBannerAds(int $page, int $categoryId)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model->where('advs.position', '=', 6); // 6 = standard banner

        if ($categoryId != 0) {
            // filter category
            $data = $data->where('advs.category', '=', $categoryId)->whereIn('advs.page', [$page, 0]);
        } 
        $data = $data->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
        ->whereDate('advs.fromdate', '<=', $today)
        ->whereDate('advs.todate', '>=', $today)
        ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getPopupAds(int $page)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 7) // 7 = popup ads
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getBelowNavigationBarAds(int $page)
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.position', '=', 8) // 8 = Below navigation bar
            ->whereIn('advs.page', [$page, 0])
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
    */
    public function getDetailAdsTop()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->where('advs.position', '=', 10) // 10 = Top detail
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getDetailAdsMiddle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->where('advs.position', '=', 11) // 11 = Middle detail
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }

    /**
     * {@inheritDoc}
     */
    public function getDetailAdsBottom()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = $this->model
            ->where('advs.status', '=', BaseStatusEnum::PUBLISHED)
            ->where('advs.position', '=', 12) // 12 = Bottom detail
            ->whereDate('advs.fromdate', '<=', $today)
            ->whereDate('advs.todate', '>=', $today)
            ->orderBy('advs.created_at', 'asc');

        return $this->applyBeforeExecuteQuery($data->get());
    }
}