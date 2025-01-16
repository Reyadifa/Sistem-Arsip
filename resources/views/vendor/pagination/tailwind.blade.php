@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-between mt-6 space-y-4 sm:space-y-0">
        {{-- Navigation Controls --}}
        <div class="flex items-center space-x-2">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="cursor-not-allowed bg-gray-300 text-gray-500 px-4 py-2 rounded-full shadow-md flex items-center">
                    <i class="fas fa-angle-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md flex items-center hover:bg-blue-600 transition">
                    <i class="fas fa-angle-left"></i>
                </a>
            @endif

            {{-- Page Numbers (Limit to 5) --}}
            @foreach (range(1, $paginator->lastPage()) as $page)
                @if ($page == $paginator->currentPage())
                    <span class="font-bold bg-blue-500 text-white px-4 py-2 rounded-full shadow-md">{{ $page }}</span>
                @elseif ($page <= 3 || $page == $paginator->lastPage())
                    <a href="{{ $paginator->url($page) }}" class="bg-gray-100 text-blue-500 px-3 py-2 rounded-full shadow-md hover:bg-blue-500 hover:text-white transition">{{ $page }}</a>
                @elseif ($page == 4)
                    <span class="text-gray-500 px-3">...</span>
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md flex items-center hover:bg-blue-600 transition">
                    <i class="fas fa-angle-right"></i>
                </a>
            @else
                <span class="cursor-not-allowed bg-gray-300 text-gray-500 px-4 py-2 rounded-full shadow-md flex items-center">
                    <i class="fas fa-angle-right"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
