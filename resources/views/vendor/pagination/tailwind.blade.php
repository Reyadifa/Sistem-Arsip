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

            {{-- Page Numbers --}}
            @if ($paginator->currentPage() > 3)
                <a href="{{ $paginator->url(1) }}" class="bg-gray-100 text-blue-500 px-3 py-2 rounded-full shadow-md hover:bg-blue-500 hover:text-white transition">1</a>
                @if ($paginator->currentPage() > 4)
                    <span class="text-gray-500 px-3">...</span>
                @endif
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="text-gray-500 px-3">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="font-bold bg-blue-500 text-white px-4 py-2 rounded-full shadow-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="bg-gray-100 text-blue-500 px-3 py-2 rounded-full shadow-md hover:bg-blue-500 hover:text-white transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <span class="text-gray-500 px-3">...</span>
                @endif
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="bg-gray-100 text-blue-500 px-3 py-2 rounded-full shadow-md hover:bg-blue-500 hover:text-white transition">{{ $paginator->lastPage() }}</a>
            @endif

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

        {{-- Go to Specific Page --}}
        <form action="{{ $paginator->url($paginator->currentPage()) }}" method="GET" class="flex items-center space-x-2">
            <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}" placeholder="Page..." class="w-20 border-gray-300 rounded-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-400">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600 transition">Go</button>
        </form>
    </nav>
@endif
