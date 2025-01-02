<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan form untuk menambah user
    public function create()
    {
        return view('users.create'); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'NIP' => 'required|string|max:255|unique:users,NIP',
        'nama_user' => 'required|string|max:255|unique:users,nama_user',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:1,2',
    ], [
        'NIP.unique' => 'NIP telah digunakan, silakan masukkan NIP yang lain.',
    ]);

    // Hash password
    $validatedData['password'] = Hash::make($validatedData['password']);

    // Buat user baru
    User::create($validatedData);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('nama_user', 'like', '%' . $search . '%');
        })->paginate(12)->appends(request()->query());
        
        return view('users.index', compact('search', 'users'));
    }
    

    // Menampilkan form untuk mengedit user
public function edit($NIP)
{
    // Mencari user berdasarkan NIP
    $user = User::where('NIP', $NIP)->firstOrFail();
    
    // Menampilkan form edit dengan data user
    return view('users.edit', compact('user'));
}

// Menyimpan perubahan data user
public function update(Request $request, $NIP)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_user' => 'required|string|max:255|unique:users,nama_user,' . $NIP . ',NIP',
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:1,2',
    ], [
        'nama_user.unique' => 'Nama pengguna sudah ada, silakan pilih nama lain.',
    ]);

    // Mencari user berdasarkan NIP
    $user = User::where('NIP', $NIP)->firstOrFail();

    // Jika password diisi, hash password baru
    if ($request->filled('password')) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        // Jika password tidak diubah, tidak perlu mengupdate password
        unset($validatedData['password']);
    }

    // Update data user
    $user->update($validatedData);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}


    // Menghapus pengguna berdasarkan NIP
    public function destroy($NIP) 
    {
        $user = User::where('NIP', $NIP)->firstOrFail(); // Mencari user berdasarkan NIP
        $user->delete(); // Menghapus user

        return redirect()->route('users.index')->with('success_delete', 'User berhasil dihapus.');
    }

}