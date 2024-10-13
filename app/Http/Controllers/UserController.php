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
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Validasi password dan konfirmasi
            'role' => 'required|in:1,2', // Validasi role
        ]);

        // Menghash password sebelum menyimpannya
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Membuat user baru
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan daftar semua pengguna
    public function index()
    {
        // Mengambil semua pengguna dengan pagination, 10 pengguna per halaman
        $users = User::paginate(10); 
        return view('users.index', compact('users'));
    }
    

    // Menampilkan form edit untuk pengguna
    public function edit($id_user) // Ganti parameter ke id_user untuk konsistensi
    {
        $user = User::findOrFail($id_user); // Mencari user berdasarkan ID
        return view('users.edit', compact('user')); // Menampilkan form edit dengan data user
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id_user)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id_user . ',id_user', // Pastikan email unik kecuali untuk user itu sendiri
            'role' => 'required|in:1,2', // Validasi role
            'password' => 'nullable|string|min:8|confirmed' // Validasi password dan konfirmasi, nullable
        ]);

        $user = User::findOrFail($id_user); // Mencari user berdasarkan ID

        // Memperbarui data user
        if ($request->filled('password')) { // Cek jika password diberikan
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Hapus password dari data yang akan diupdate
        }

        $user->update($validatedData); // Memperbarui data user

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy($id_user) // Ganti parameter ke id_user untuk konsistensi
    {
        $user = User::findOrFail($id_user); // Mencari user berdasarkan ID
        $user->delete(); // Menghapus user

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}