<?php

namespace Botble\Advs\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Traits\HasDeleteManyItemsTrait;
use Botble\Advs\Forms\AdvsForm;
use Botble\Advs\Tables\AdvsTable;
use Botble\Advs\Http\Requests\AdvsRequest;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Advs\Models\Advs;

class AdvsController extends BaseController
{
    use HasDeleteManyItemsTrait;


    protected $advsRepository;


    public function __construct(AdvsInterface $advsRepository)
    {
        $this->advsRepository = $advsRepository;
    }


    public function index(AdvsTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/advs::advs.advs'));

        return $dataTable->renderTable();
    }

    /**
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/advs::advs.create'));

        return $formBuilder->create(AdvsForm::class)->renderForm();
    }


    public function store(AdvsRequest $request, BaseHttpResponse $response)
    {

        $advs = $this->advsRepository->getModel();
        $advs->fill($request->input());
        $advs->user_id = Auth::user()->getKey();
        if ($request->input('istop') == 1) {
            $this->advsRepository->Update(['istop' => 1], ['istop' => 0]);
        }


        $advs = $this->advsRepository->createOrUpdate($advs);

        event(new CreatedContentEvent(ADVS_MODULE_SCREEN_NAME, $request, $advs));

        return $response
            ->setPreviousUrl(route('advs.index'))
            ->setNextUrl(route('advs.edit', $advs->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }


    public function edit($id, Request $request, FormBuilder $formBuilder)
    {
        $advs = $this->advsRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $advs));

        page_title()->setTitle(trans('plugins/advs::advs.edit') . ' "' . $advs->name . '"');

        return $formBuilder->create(AdvsForm::class, ['model' => $advs])->renderForm();
    }


    public function update($id, AdvsRequest $request, BaseHttpResponse $response)
    {
        if (!$request->input('is_html')) {
            $request->merge(array('is_html' => 0, 'html' => ''));
        }

        $advs = $this->advsRepository->findOrFail($id);
        $advs->fill($request->input());
        if ($request->input('istop') == 1) {
            $this->advsRepository->Update(['istop' => 1], ['istop' => 0]);
        }

        $this->advsRepository->createOrUpdate($advs);

        event(new UpdatedContentEvent(ADVS_MODULE_SCREEN_NAME, $request, $advs));

        return $response
            ->setPreviousUrl(route('advs.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $advs = $this->advsRepository->findOrFail($id);
            $this->advsRepository->delete($advs);
            event(new DeletedContentEvent(ADVS_MODULE_SCREEN_NAME, $request, $advs));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->advsRepository, ADVS_MODULE_SCREEN_NAME);
    }
}