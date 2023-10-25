@if ($paginator->hasPages())
    <div class="pagination-list">
        <ul class="list-inline">
            @if ($paginator->onFirstPage())
            <li><span><i class="las la-arrow-left"></i></span></li>
            @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
            @endif
            @foreach ($elements as $element)
            @if (is_string($element))
            <li><span>{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li><span class="active">{{ $page }}</span></li>
                @else
                <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
            @endif
            @endforeach
            @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
            @else
            <li><span><i class="las la-arrow-right"></i></span></li>
            @endif
        </ul>
    </div>
@endif
