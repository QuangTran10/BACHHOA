{{-- <ul class="pagination">
  <li class="page-item">
    <a class="page-link" href="#link" aria-label="Previous">
      <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
  </a>
</li>
<li class="page-item">
    <a class="page-link" href="#link">1</a>
</li>
<li class="page-item active">
    <a class="page-link" href="#link">2</a>
</li>
<li class="page-item">
    <a class="page-link" href="#link">3</a>
</li>
<li class="page-item">
    <a class="page-link" href="#link" aria-label="Next">
      <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
  </a>
</li>
</ul> --}}

@if ($paginator->hasPages())
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item" class="disabled" aria-disabled="true">
                    <a class="page-link" href="#link" aria-label="Previous">
                      <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                      <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item" class="disabled" aria-disabled="true">
                        <a class="page-link" href="#link">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="#link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                      <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                  </a>
              </li>
            @else
                <li class="page-item" class="disabled" aria-disabled="true">
                    <a class="page-link" href="#link" aria-label="Next">
                      <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                  </a>
              </li>
            @endif
        </ul>
@endif

