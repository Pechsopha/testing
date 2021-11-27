<?php

namespace Botble\Advs\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;

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
}