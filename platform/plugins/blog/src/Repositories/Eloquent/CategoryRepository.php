<?php

namespace Botble\Blog\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Botble\Blog\Models\Post;

class CategoryRepository extends RepositoriesAbstract implements CategoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->with('slugable')
            ->where('categories.status', BaseStatusEnum::PUBLISHED)
            ->select('categories.*')
            ->orderBy('categories.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedCategories($limit)
    {
        $data = $this->model
            ->with('slugable')
            ->where([
                'categories.status'      => BaseStatusEnum::PUBLISHED,
                'categories.is_featured' => 1,
            ])
            ->select([
                'categories.id',
                'categories.name',
                'categories.icon',
            ])
            ->orderBy('categories.order', 'asc')
            ->select('categories.*')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCategories(array $condition = [], array $with = [])
    {
        $data = $this->model->with('slugable')->select('categories.*');
        if (!empty($condition)) {
            $data = $data->where($condition);
        }

        $data = $data
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('categories.created_at', 'DESC')
            ->orderBy('categories.order', 'DESC');

        if ($with) {
            $data = $data->with($with);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryById($id)
    {
        $data = $this->model->with('slugable')->where([
            'categories.id'     => $id,
            'categories.status' => BaseStatusEnum::PUBLISHED,
        ]);

        return $this->applyBeforeExecuteQuery($data, true)->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories(array $select, array $orderBy)
    {
        $data = $this->model->with('slugable')->select($select);
        foreach ($orderBy as $by => $direction) {
            $data = $data->orderBy($by, $direction);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllRelatedChildrenIds($id)
    {
        if ($id instanceof Eloquent) {
            $model = $id;
        } else {
            $model = $this->getFirstBy(['categories.id' => $id]);
        }
        if (!$model) {
            return null;
        }

        $result = [];

        $children = $model->children()->select('categories.id')->get();

        foreach ($children as $child) {
            $result[] = $child->id;
            $result = array_merge($this->getAllRelatedChildrenIds($child), $result);
        }
        $this->resetModel();

        return array_unique($result);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCategoriesWithChildren(array $condition = [], array $with = [], array $select = ['*'])
    {
        $data = $this->model
            ->where($condition)
            ->with($with)
            ->select($select);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters($filters)
    {
        $this->model = $this->originalModel;

        $orderBy = isset($filters['order_by']) ? $filters['order_by'] : 'created_at';
        $order = isset($filters['order']) ? $filters['order'] : 'desc';
        $this->model->where('status', BaseStatusEnum::PUBLISHED)->orderBy($orderBy, $order);

        return $this->applyBeforeExecuteQuery($this->model)->paginate((int)$filters['per_page']);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryByIds($ids)
    {
        $data = $this->model->with('slugable')->whereIn('categories.id', $ids)->where([
            'categories.status' => BaseStatusEnum::PUBLISHED,
        ]);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getPopularCategories()
    {
        $popularCategory = DB::select('
            SELECT 
                categories.id,
                (SELECT 
                sum(posts.views) 
                FROM posts 
                LEFT JOIN 
                post_categories on posts.id = post_categories.post_id 
                WHERE post_categories.category_id = categories.id)
                as total_views
            FROM categories 
            LIMIT 5;');

        $categoryIds = [];

        foreach ($popularCategory as $key => $value) {
            array_push($categoryIds, $value->id);
        }

        return $this->getCategoryByIds($categoryIds);

    }
}
