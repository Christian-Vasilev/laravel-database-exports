<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\ProductTypeEnum;
use App\Exports\UsersExport;
use App\Http\Requests\StoreExportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exports.index', [
            'statuses' => OrderStatusEnum::cases(),
            'types' => ProductTypeEnum::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExportRequest $request)
    {
        $orderStatuses = OrderStatusEnum::getFilterableStatusesAsArray($request->get('status'));
        $productTypes = ProductTypeEnum::getFilterableTypesAsArray($request->get('type'));



        return Excel::download(new UsersExport($orderStatuses, $productTypes), 'export.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
