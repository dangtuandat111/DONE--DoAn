<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>STT</th>
                <th class="sortStyle unsortStyle">Name</th>
                <th class="sortStyle unsortStyle">Slug</th>
                <th class="sortStyle unsortStyle">Price</th>
                <th class="sortStyle unsortStyle">Created at</th>
                <th class="sortStyle unsortStyle">Updated at</th>
                <th class="sortStyle unsortStyle">Thumbnail</th>
                <th class="sortStyle unsortStyle">Status</th>
                <th class="sortStyle unsortStyle">More Info</th>
                <th class="sortStyle unsortStyle">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($product_data as $product_data_item)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $product_data_item['name'] }}</td>
                    <td>{{ $product_data_item['slug'] }}</td>
                    <td>{{ $product_data_item['price'] }}$</td>
                    <td>{{ $product_data_item['c_at'] }}</td>
                    <td>{{ $product_data_item['u_at'] }}</td>
                    <td>
                        <img class="@if(!$product_data_item['img']) d-none @endif" src="{{ asset($product_data_item['img']) }}" alt="">
                    </td>
                    <td>{{ $product_data_item['status'] }}</td>
                    <td>
                        <button class="add btn btn-icon text-primary expand-button bg-transparent align-content-center"><i
                                class="icon-circle-plus"></i></button>
                    </td>
                    <td>
                        <a type="button" class="btn btn-outline-info btn-fw padding-action" href="">Edit</a>
                    </td>
                </tr>
                <tr class="product_detail expandable-table d-none">
                    <td colspan="12">
                        <div>
                            <div class="d-flex justify-content-between">
                                <div class="cell-hilighted">
                                    <div class="d-flex mb-2">
                                        <div class="me-2 min-width-cell">
                                            <p>Created at</p>
                                            <h6>
                                                {{ $product_data_item->c_at }}
                                            </h6>
                                        </div>
                                        <div class="min-width-cell">
                                            <p>Last updated</p>
                                            <h6>
                                                {{ $product_data_item->u_at }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div class="me-2 min-width-cell">
                                            <p>Last discount start</p>
                                            <h6>
                                                {{ $product_data_item->s_at }}
                                            </h6>
                                        </div>
                                        <div class="min-width-cell">
                                            <p>Last discount end</p>
                                            <h6>
                                                {{ $product_data_item->e_at }}
                                            </h6>
                             `           </div>
                                    </div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Discount</p><h6>{{ $product_data_item['discount'] }}</h6></div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4">
                                        <p>Feature List</p>
                                        <ul class="two-column-order-list">
                                            @foreach($product_data_item['feature_list'] as $feature)
                                                <li>
                                                    <h6>{{ $feature }}</h6>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Brand name</p><h6>{{ $product_data_item['brand_name'] }}</h6></div>
                                    <div class="me-2"><p>Brand slug</p><h6>{{ $product_data_item['brand_slug'] }}</h6></div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Category name</p><h6>{{ $product_data_item['category_name'] }}</h6></div>
                                    <div class="me-2"><p>Catgory slug</p><h6>{{ $product_data_item['category_slug'] }}</h6></div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>

        @if($product_data instanceof Illuminate\Pagination\LengthAwarePaginator)
            {{ $product_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $product_data])  }}
        @endif
    </td>
</div>
