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
            ->add('position', 'select', [
                'label'      => trans('core/base::forms.position'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    1 => 'Top-Content-Detail',
                    2 => 'Home-Page',
                ],
            ])
            ->add('link', 'text', [
                'label'      => trans('core/base::forms.link'),
                'label_attr' => ['class' => 'control-label'],
            ])->add('rowOpen1', 'html', [
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
            ->add('istop', 'onOff', [
                'label'         => trans('core/base::forms.istop'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => false,
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