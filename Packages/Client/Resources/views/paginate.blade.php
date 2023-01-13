<div class="pagination-wrapper float-left w-100">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item @if ($paginator->onFirstPage()) disabled @endif">
                <a class="page-link page-link-page" aria-label="Previous" data-href="@if ($paginator->hasMorePages()) {{ explode('?page=', $paginator->nextPageUrl())[1] }}@endif">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a href="#" aria-controls="order-listing" data-dt-idx="{{ $page }}" tabindex="{{ $page - 1 }}" class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a data-page="{{ $page }}" aria-controls="order-listing" tabindex="0" class="page-link page-link-page">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li class="page-item @if (!$paginator->hasMorePages()) disabled @endif">
                <a class="page-link page-link-page" aria-label="Next" data-page="@if ($paginator->hasMorePages()) {{ explode('?page=', $paginator->nextPageUrl())[1] }}@endif">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
