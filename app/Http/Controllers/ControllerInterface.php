<?php
namespace App\Http\Controllers;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Interface ControllerInterface
 *
 * @package App\Http\Controllers
 */
interface ControllerInterface
{
    public function index();

    public function create();

    /**
     * @param Request $request
     */
    public function store(Request $request);

    /**
     * @param int $id
     */
    public function show(int $id);

    /**
     * @param int $id
     */
    public function edit(int $id);

    /**
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id);

    /**
     * @param int $id
     */
    public function destroy(int $id);

    /**
     * @return ServiceInterface
     */
    public function getService(): ServiceInterface;

    /**
     * @param string|null $view
     * @param array $data
     * @param array $mergeData
     * @return Response
     */
    public function getView(string $view = null, array $data = [], array $mergeData = []): Response;
}