<?php

namespace Botble\Advs;

use Botble\Advs\Repositories\Interfaces\AdvsMetaInterface;
use Illuminate\Support\Arr;
use Theme;

class Advs
{
    /**
     * @var GalleryMetaInterface
     */
    protected $advsMetaRepository;

    /**
     * Gallery constructor.
     * @param GalleryMetaInterface $galleryMetaRepository
     */
    public function __construct(AdvsMetaInterface $advsMetaRepository)
    {
        $this->advsMetaRepository = $advsMetaRepository;
    }

    /**
     * @param string | array $model
     * @return Gallery
     */
    public function registerModule($model)
    {
        if (!is_array($model)) {
            $model = [$model];
        }
        config([
            'plugins.advs.general.supported' => array_merge(config('plugins.gallery.general.supported', []), $model),
        ]);

        return $this;
    }

    /**
     * @param string | array $model
     * @return Gallery
     */
    public function removeModule($model)
    {
        $models = config('plugins.gallery.general.supported', []);

        foreach ($models as $key  => $item) {
            if ($item == $model) {
                Arr::forget($models, $key);
                break;
            }
        }

        config(['plugins.advs.general.supported' => $models]);

        return $this;
    }

    /**
     * @param string $screen
     * @param \Illuminate\Http\Request $request
     * @param \Eloquent|false $data
     */
    public function saveAdvs($request, $data)
    {
        if ($data != false && in_array(get_class($data), config('plugins.gallery.general.supported', []))) {
            if (empty($request->input('gallery'))) {
                $this->advsMetaRepository->deleteBy([
                    'reference_id'   => $data->id,
                    'reference_type' => get_class($data),
                ]);
            }
            $meta = $this->advsMetaRepository->getFirstBy([
                'reference_id'   => $data->id,
                'reference_type' => get_class($data),
            ]);
            if (!$meta) {
                $meta = $this->advsMetaRepository->getModel();
                $meta->reference_id = $data->id;
                $meta->reference_type = get_class($data);
            }

            $meta->images = $request->input('gallery');
            $this->advsMetaRepository->createOrUpdate($meta);
        }
    }

    /**
     * @param string $screen
     * @param \Eloquent|false $data
     */
    public function deleteAdvs($data)
    {
        if (in_array(get_class($data), config('plugins.gallery.general.supported', []))) {
            $this->galleryMetaRepository->deleteBy([
                'reference_id'   => $data->id,
                'reference_type' => get_class($data),
            ]);
        }

        return true;
    }

    /**
     * @return $this
     */
    public function registerAssets()
    {
        Theme::asset()
            ->usePath(false)
            ->add('lightgallery-css', 'vendor/core/plugins/gallery/css/lightgallery.min.css')
            ->add('gallery-css', 'vendor/core/plugins/gallery/css/gallery.css');

        Theme::asset()
            ->container('footer')
            ->add('lightgallery-js', 'vendor/core/plugins/gallery/js/lightgallery.min.js', ['jquery'])
            ->add('imagesloaded', 'vendor/core/plugins/gallery/js/imagesloaded.pkgd.min.js', ['jquery'])
            ->add('masonry', 'vendor/core/plugins/gallery/js/masonry.pkgd.min.js', ['jquery'])
            ->add('gallery-js', 'vendor/core/plugins/gallery/js/gallery.js', ['jquery']);

        return $this;
    }
}