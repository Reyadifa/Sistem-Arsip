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
            @foreach (range(1, min(5, $paginator->lastPage())) as $page)
                @if ($page == $paginator->currentPage())
                    <span class="font-bold bg-blue-500 text-white px-4 py-2 rounded-full shadow-md">{{ $page }}</span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="bg-gray-100 text-blue-500 px-3 py-2 rounded-full shadow-md hover:bg-blue-500 hover:text-white transition">{{ $page }}</a>
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

        {{-- Go to Specific Page --}}
        <form action="{{ $paginator->url($paginator->currentPage()) }}" method="GET" class="flex items-center space-x-2">
            <label for="page" class="text-gray-700 font-medium">Page:</label>
            <input type="number" id="page" name="page" min="1" max="{{ $paginator->lastPage() }}" placeholder="1" class="w-20 border-gray-300 rounded-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-blue-400">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600 transition">Go</button>
        </form>
    </nav>
@endif
