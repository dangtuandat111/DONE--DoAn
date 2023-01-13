<div class="row mt-4">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Hiển thị {{ $data_pagination->perPage() * ($data_pagination->currentPage() - 1) + 1 }}
            từ {{ $data_pagination->perPage() * $data_pagination->currentPage() }}
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
            <ul class="pagination d-flex justify-content-end">
                <li class="paginate_button page-item previous @if ($paginator->onFirstPage()) disabled @endif" id="order-listing_previous">
                    <a data-page="@if (!$paginator->onFirstPage()) {{ explode('?page=', $paginator->previousPageUrl())[1] }} @endif" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link page-link-page">Trước</a>
                </li>

                <li class="paginate_button page-item active">
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="order-listing" data-dt-idx="{{ $page }}" tabindex="{{ $page - 1 }}" class="page-link">{{ $page }}</a>
                                </li>
                                @else
                                    <li>
                                        <a data-page="{{ $page }}" aria-controls="order-listing" tabindex="0" class="page-link page-link-page">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </li>

                {{-- Next Page Link --}}
                <li class="paginate_button page-item next @if (!$paginator->hasMorePages()) disabled @endif" id="order-listing_next">
                    <a data-page="@if ($paginator->hasMorePages()) {{ explode('?page=', $paginator->nextPageUrl())[1] }}@endif"
                       aria-controls="order-listing"
                       data-dt-idx="2"
                       tabindex="0"
                       class="page-link page-link-page">Tiếp
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

