<?php

namespace App\Http\Controllers;

use App\Enums\ProductTypeEnum;
use App\Exports\UsersExport;
use App\Http\Requests\StoreExportRequest;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exports.index', [
            'types' => ProductTypeEnum::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function users(StoreExportRequest $request)
    {
        $productTypes = ProductTypeEnum::getFilterableTypesAsArray($request->get('type'));

        return Excel::download(new UsersExport($productTypes), 'export.xlsx');
    }
}
