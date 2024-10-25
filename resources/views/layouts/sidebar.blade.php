<aside class="w-64 bg-gradient-to-b h-screen bg-blue-500 text-white p-6 ">
    <div class="flex justify-center mb-4 ">
        <img class="w-32" src="{{ asset('img/bpkad.png') }}" alt="BPKAD">

    </div>
    <hr class="border-2">
    <nav>
        <ul class="space-y-4">
            
            @if(Auth::user()->role == 1) {{-- Untuk Admin --}}

          
            <li class="mt-4">
                <a href="/dashboard" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">dashboard</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            
            
            <li>
                <a href="/arsip" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">archive</span>
                    <span class="ml-2">Arsip</span>
                </a>
            </li>

            <li class="mt-4">
                <a href="/peminjaman" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">library_books</span>
                    <span class="ml-2">Peminjaman</span>
                </a>
            </li>

            <li>
                <a href="/kategori" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">category</span>
                    <span class="ml-2">Kategori</span>
                </a>
            </li>
            <li>
                <a href="/users" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">person</span>
                    <span class="ml-2">User</span>
                </a>
            </li>

            @elseif(Auth::user()->role == 2) {{-- Untuk User --}}
            <li class="mt-4">
                <a href="/dashboard" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">dashboard</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/arsip" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                    <span class="material-icons">archive</span>
                    <span class="ml-2">Arsip</span>
                </a>
            </li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                        <span class="material-icons">logout</span>
                        <span class="ml-2">Logout</span>
                    </button>
                </form>
            </li>            
        </ul>
    </nav>
</aside>
