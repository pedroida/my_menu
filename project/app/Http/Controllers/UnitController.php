<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Repositories\UnitRepository;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->repository = new UnitRepository();
        $this->resource = UnitResource::class;
    }

    public function index()
    {
        return view('units.index');
    }

    public function create()
    {
        $unit = Unit::factory()->empty()->make();

        return view('units.create', compact('unit'));
    }

    public function store(UnitRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'units.index');
    }

    public function edit($id)
    {
        $unit = $this->repository->findOrFail($id);
        return view('units.edit', compact('unit'));
    }

    public function update(UnitRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'units.index');
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->defaultOrderBy('name', 'DESC')
            ->resource($this->resource);
    }
}
