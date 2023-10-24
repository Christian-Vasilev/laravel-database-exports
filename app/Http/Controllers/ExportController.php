<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\ProductTypeEnum;
use App\Exports\UsersExport;
use App\Http\Requests\StoreExportRequest;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
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
    public function export(StoreExportRequest $request)
    {
        $orderStatuses = OrderStatusEnum::getFilterableStatusesAsArray($request->get('status'));
        $productTypes = ProductTypeEnum::getFilterableTypesAsArray($request->get('type'));

        return Excel::download(new UsersExport($orderStatuses, $productTypes), 'export.xlsx');
    }
}
