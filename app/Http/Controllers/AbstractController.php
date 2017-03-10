<?php
namespace App\Http\Controllers;

use App\EntityInterface;
use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Services\DataTable;

/**
 * Abstract Class AbstractController
 *
 * @package App\Http\Controllers
 */
abstract class AbstractController extends Controller implements ControllerInterface
{
    /** @var  EntityInterface */
    protected $entity;

    public function __construct() {
        session(['entity' => $this->getEntityName()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->getDataTable()->render('abstract.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('abstract.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getEntity()->storeRules($request));

        $this->getService()->store($request->only($this->getEntity()->storeRequestAttributes()));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $entity = $this->getService()->findOrFail($id);

        return view('abstract.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $entity = $this->getService()->findOrFail($id);

        return view('abstract.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, $this->getEntity()->updateRules($request));

        $entity = $this->getService()->findOrFail($id);

        $service = $this->getService()->setEntity($entity);

        $service->update($request->only($this->getEntity()->updateRequestAttributes()));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $entity = $this->getService()->findOrFail($id);

        $service = $this->getService()->setEntity($entity);

        $service->destroy();

        return back();
    }

    /**
     * @return ServiceInterface
     */
    public function getService(): ServiceInterface
    {
        /** @var ServiceInterface $service */
        $service = (new \ReflectionClass(preg_replace('/App\\\/', 'App\\Services\\', $this->entity) .'Service'))->newInstanceArgs();

        $service->setEntity(new $this->entity);

        return $service;
    }

    /**
     * @param string|null $view
     * @param array $data
     * @param array $mergeData
     * @return Response
     */
    public function getView(string $view = null, array $data = [], array $mergeData = []): Response
    {
        $folder = strtolower(preg_replace('/App\\\/', '', $this->entity));

        return view($folder.'.'.$view, $data, $mergeData);
    }

    /**
     * @return DataTable
     */
    public function getDataTable(): DataTable
    {
        $datatable = preg_replace('/App\\\/', 'App\\DataTables\\', $this->entity) .'sDataTable';

        return new $datatable(app('datatables'), app('view'));
    }

    public function getEntityName(): string
    {
        return strtolower(preg_replace('/App\\\/', '', $this->entity));
    }

    public function getEntity(): EntityInterface
    {
        return new $this->entity;
    }
}
