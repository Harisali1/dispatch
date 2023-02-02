@if ($paginator->hasPages())
    <div class="cs_pagination">
        <ul class="no-list d-flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="javascript:void(0)" class="cs_btn" style="background-color: lightgrey">Previous</a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                       class="cs_btn">Previous</a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            <li>
                <select name="" id="" class="form-control pages-dd"
                        onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <option value="1">Page - {{ $element }}</option>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <option value="1" {{ ($page == $paginator->currentPage()) ? 'selected' : '' }}>Page - {{ $page }}</option>
                                @else
                                    <option value="{{$url}}">Page - {{ $page }}</option>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </li>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')" class="cs_btn">Next
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')" >
                    <a href="javascript:void(0)" class="cs_btn" style="background-color: lightgrey">Next</a>
                </li>
            @endif
        </ul>
    </div>
@endif
