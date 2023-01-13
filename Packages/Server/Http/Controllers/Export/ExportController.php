<?php

namespace Packages\Server\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Export\ExportFile;

class ExportController extends Controller {
    public function exportDoanhThu(Request $request) {
        if ($request->get('month') && $request->get('month') != null) {
            $month = $request->get('month');
        } else {
            $month = Carbon::now()->month;
        }

        if ($request->get('year') && $request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = Carbon::now()->year;
        }
        return ((new ExportFile($month, $year))->download('report.xlsx'));
    }

}
