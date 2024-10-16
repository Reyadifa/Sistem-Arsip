@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-6">
        <div class="flex items-center space-x-2">
            {{-- Link ke halaman sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="disabled">«</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-blue-500 hover:underline">«</a>
            @endif

            {{-- Menampilkan link ke halaman numerik --}}
            @if ($paginator->currentPage() > 3)
                <a href="{{ $paginator->url(1) }}" class="text-blue-500 hover:underline">1</a>
                @if ($paginator->currentPage() > 4)
                    <span class="disabled">...</span>
                @endif
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="disabled">{{ $element }}</span>
                @endif

                {{-- Link ke halaman numerik --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Cek apakah halaman adalah halaman pertama atau terakhir, untuk menghindari duplikasi --}}
                        @if ($page != $paginator->currentPage() && $page != 1 && $page != $paginator->lastPage())
                            <a href="{{ $url }}" class="text-blue-500 border border-gray-300 px-3 py-1 rounded hover:bg-blue-500 hover:text-white">{{ $page }}</a>
                        @elseif ($page == $paginator->currentPage())
                            <span class="font-bold text-blue-500 border border-blue-500 px-3 py-1 rounded">{{ $page }}</span>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <span class="disabled">...</span>
                @endif
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="text-blue-500 hover:underline">{{ $paginator->lastPage() }}</a>
            @endif

            {{-- Link ke halaman berikutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-blue-500 hover:underline">»</a>
            @else
                <span class="disabled">»</span>
            @endif
        </div>

        {{-- Input untuk memasukkan nomor halaman --}}
        <form action="{{ $paginator->url($paginator->currentPage()) }}" method="GET" class="flex items-center">
            <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}" placeholder="Go to..." class="border rounded p-1">
            <button type="submit" class="ml-2 bg-blue-500 text-white rounded p-1">Go</button>
        </form>
    </nav>
@endif
