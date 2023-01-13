<?php

namespace Packages\Server\Services\OrderService;

use Illuminate\Support\Facades\DB;

class OrderService {
    public function getOrder()  {
        $order_list = DB::table('order')->paginate(15);

        foreach($order_list as $key => $order) {
           $customer_name[] = DB::table('customer')->where('id', '=', $order->id_customer)->get('name')[0]->name;
        }
        return [$order_list, $customer_name];
    }

    public function getOrderList($id, $page) {
        $order_detail_list = DB::table('order_detail')->where(['id_order' => $id])->paginate(15,['*'],'page',$page);
        foreach($order_detail_list as $key => $order) {
            $id_product = DB::table('product_variant')->where('id', '=', $order->id_product_variant)->get()[0]->id_product;
            $product_name[] = DB::table('product')->where('id', '=', $id_product)->get('name')[0]->name;
        }
        return [$order_detail_list, $product_name];
    }
}
