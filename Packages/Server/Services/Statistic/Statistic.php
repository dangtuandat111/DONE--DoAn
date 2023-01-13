<?php

namespace Packages\Server\Services\Statistic;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Statistic
{
    public function getData($page = 1,$perpage = 1, $month, $year) {
//        dd($page ,$perpage , $month, $year);
        $data = DB::table('product_variant')
            ->join('order_detail', 'order_detail.id_product_variant', '=', 'product_variant.id')
            ->join('product', 'product.id', '=', 'product_variant.id_product')
            ->join('order', 'order.id', '=', 'order_detail.id_order')
            ->whereMonth('order.created_at' ,'=', $month)
            ->whereYear('order.created_at' ,'=', $year)
            ->select(['product_variant.id_product', DB::raw('SUM(order_detail.price * order_detail.count) AS nsum'), 'product.name'])
            ->groupBy('product_variant.id_product', 'product.name')
            ->paginate($perpage,['*'],'page', $page);
        return $data;
    }


    public function getSellData($month, $year)
    {
        $data = DB::table('product_variant')
            ->join('order_detail', 'order_detail.id_product_variant', '=', 'product_variant.id')
            ->join('product', 'product.id', '=', 'product_variant.id_product')
            ->join('order', 'order.id', '=', 'order_detail.id_order')
            ->whereMonth('order.created_at' ,'=', $month)
            ->whereYear('order.created_at' ,'=', $year)
            ->select([DB::raw('SUM(order_detail.price * order_detail.count) AS nsum'), 'product.name'])
            ->groupBy('product_variant.id_product', 'product.name')
            ->get();

        if (count($data) == 0) {
            return [[], []];
        }

        foreach($data as $item) {
            $pv_name[] = $item->name;
            $total[] = $item->nsum;
        }

        return [$pv_name, $total];
   }

   public function getSellCount($page = 1,$perpage = 1, $month, $year) {
       $sellData = DB::table('order_detail')
           ->join('product_variant', 'order_detail.id_product_variant', '=', 'product_variant.id')
           ->join('product', 'product.id', '=', 'product_variant.id_product')
           ->join('order', 'order.id', '=', 'order_detail.id_order')
           ->whereMonth('order.created_at' ,'=', $month)
           ->whereYear('order.created_at' ,'=', $year)
           ->select([DB::raw('SUM(order_detail.count) AS scount'), 'product.name'])
           ->groupBy('product.name')
           ->paginate($perpage,['*'],'page', $page);

       return $sellData;
   }


   public function getCountProd() {
        $totalCount = DB::table('product_variant')
            ->join('product', 'product_variant.id_product', '=', 'product.id')
            ->select([DB::raw('SUM(product_variant.count) AS pcount'), 'product.name'])
            ->groupBy('product.name')
            ->get();

       if (count($totalCount) == 0) {
           return [[], []];
       }

       foreach($totalCount as $item) {
           $pname[] = $item->name;
           $pcount[] = $item->pcount;
       }

       return [$pname, $pcount];
   }

    public function getSellChart() {
        $totalCount = DB::table('order_detail')
            ->join('product_variant', 'order_detail.id_product_variant', '=', 'product_variant.id')
            ->join('product', 'product.id', '=', 'product_variant.id_product')
            ->select([DB::raw('SUM(order_detail.count) AS scount'), 'product.name'])
            ->groupBy('product.name')
            ->get();

        if (count($totalCount) == 0) {
            return [[], []];
        }

        foreach($totalCount as $item) {
            $pname[] = $item->name;
            $pcount[] = $item->scount;
        }

        return [$pname, $pcount];
    }

}
