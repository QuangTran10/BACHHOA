@if ($paginator->hasPages())
    <div class="shop-pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <button class="no-round-btn smooth"> <i class="arrow_carrot-2left"></i></button>
                </li>
            @else
                <li>
                    <button class="no-round-btn smooth">
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="arrow_carrot-2left"></i></a>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <button class="no-round-btn smooth">{{ $element }}</button>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <button class="no-round-btn smooth active">{{ $page }}</button>
                            </li>
                        @else
                            <li>
                                <button class="no-round-btn smooth">
                                   <a href="{{ $url }}">{{ $page }}</a>
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button class="no-round-btn smooth">
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="arrow_carrot-2right"></i></a>
                    </button>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <button class="no-round-btn smooth" aria-hidden="true"><i class="arrow_carrot-2right"></i></button>
                </li>
            @endif
        </ul>
    </div>
@endif
