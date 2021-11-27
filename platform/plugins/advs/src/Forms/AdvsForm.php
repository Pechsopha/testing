<?php

namespace Botble\Advs\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Advs\Http\Requests\AdvsRequest;
use Botble\Advs\Models\Advs;

class AdvsForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $allCategories = get_all_categories();
        $categoryDropdownDataSet = [];

        foreach ($allCategories as $category) {
            $id = $category->id;
            $name = $category->name;

            $categoryDropdownDataSet[strval($id)] = $name;
        }

        $this
            ->setupModel(new Advs)
            ->setValidatorClass(AdvsRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('page', 'select', [
                'label' => trans('core/base::forms.page'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    0 => 'All Pages',
                    1 => 'Home Page',
                    2 => 'Category Page',
                    3 => 'Detail Page'
                ]
            ])
            ->add('position', 'select', [
                'label'      => trans('core/base::forms.position'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    1 => 'Left Side (160x600)',
                    2 => 'Right Side (160x600)',
                    3 => 'Leaderboard (728x90)',
                    4 => 'Below Facebook Page (336x280)',
                    5 => 'Below Popular Post (336x280)',
                    6 => 'Top Category (468x60)',
                    7 => 'Popup',
                    8 => 'Below Header (728x90)',
                    10 => 'Detail - Top (468x60)',
                    11 => 'Detail - Middle (468x60)',
                    12 => 'Detail - Bottom (468x60)'
                ],
            ])
            ->add('category', 'select', [
                'label' => trans('core/base::forms.category'),
                'label_attr' => ['class' => 'control-label d-none'],
                'attr' => ['class' => 'form-control d-none'],
                'choices' => $categoryDropdownDataSet
            ])
            ->add('link', 'text', [
                'label'      => trans('core/base::forms.link'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('is_html', 'checkbox', [
                'label' => trans('core/base::forms.is_html'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'value' => '1'
                ]
            ])
            ->add('html', 'textarea', [
                'attr' => ['disabled']
            ])
            ->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('fromdate', 'text', [
                'label'      => trans('core/base::forms.fromdate'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => 'form-group col-md-6',
                ],
                'attr' => ['class' => "datepicker form-control", 'data-date-format' => config('core.base.general.date_format.js.date')]
            ])
            ->add('todate', 'text', [
                'label'      => trans('core/base::forms.todate'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => 'form-group col-md-6',
                ],
                'attr' => ['class' => "datepicker form-control", 'data-date-format' => config('core.base.general.date_format.js.date')]
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->add('image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])

            ->setBreakFieldPoint('status');
    }
}