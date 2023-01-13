<?php

namespace Packages\Server\Services\Export;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportService {
    public function getDoanhThu($month, $year) {

        $data = $data = DB::table('product_variant')
            ->join('order_detail', 'order_detail.id_product_variant', '=', 'product_variant.id')
            ->join('product', 'product.id', '=', 'product_variant.id_product')
            ->join('order', 'order.id', '=', 'order_detail.id_order')
            ->whereMonth('order.created_at' ,'=', $month)
            ->whereYear('order.created_at' ,'=', $year)
            ->select(['product.id', 'product_variant.id as id_pv', DB::raw('SUM(order_detail.price * order_detail.count) AS nsum'), 'product.name'])
            ->groupBy('product.id', 'product_variant.id_product', 'product.name', 'product_variant.id')
            ->get();

        foreach($data as $item) {
            $item->price = DB::table('product')
                ->where([
                    'id' => $item->id,
                ])->get('price')[0]->price;
            $item->count = DB::table('product_variant')
                ->where([
                    'id' => $item->id_pv,
                ])
                ->select(DB::raw('SUM(product_variant.count) as snum'))
                ->groupBy('product_variant.id')
                ->get()[0]->snum;
        }
        return $data;
    }

}
