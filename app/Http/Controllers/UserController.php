<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('nama_user', 'like', '%' . $search . '%')
                         ->orWhere('NIP', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(12)
        ->appends(request()->query());
        
        return view('users.index', compact('search', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'NIP' => 'required|string|max:255|unique:users,NIP',
            'nama_user' => 'required|string|max:255|unique:users,nama_user',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:1,2,3',
        ], [
            'NIP.required' => 'NIP harus diisi.',
            'NIP.unique' => 'NIP telah digunakan, silakan masukkan NIP yang lain.',
            'nama_user.required' => 'Nama user harus diisi.',
            'nama_user.unique' => 'Nama user telah digunakan, silakan masukkan nama yang lain.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role harus dipilih.',
            'role.in' => 'Role tidak valid.',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Buat user baru
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($NIP)
    {
        // Mencari user berdasarkan NIP
        $user = User::where('NIP', $NIP)->firstOrFail();
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $NIP)
    {
        // Mencari user berdasarkan NIP
        $user = User::where('NIP', $NIP)->firstOrFail();

        // Validasi input
        $validatedData = $request->validate([
            'nama_user' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'nama_user')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:1,2,3',
        ], [
            'nama_user.required' => 'Nama user harus diisi.',
            'nama_user.unique' => 'Nama user sudah ada, silakan pilih nama lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role harus dipilih.',
            'role.in' => 'Role tidak valid.',
        ]);

        // Jika password diisi, hash password baru
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Jika password tidak diubah, hapus dari data yang akan diupdate
            unset($validatedData['password']);
        }

        // Update data user
        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($NIP) 
    {
        $user = User::where('NIP', $NIP)->firstOrFail();
        
        // Cek apakah user yang akan dihapus adalah user yang sedang login
        if (Auth::user()->NIP === $NIP) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }
        
        $user->delete();

        return redirect()->route('users.index')->with('success_delete', 'User berhasil dihapus.');
    }

    /**
     * Get role name helper
     */
    private function getRoleName($roleId)
    {
        $roleMap = [
            1 => 'Pendataan',
            2 => 'Pelayanan',
            3 => 'Pengarsipan',
        ];

        return $roleMap[$roleId] ?? 'Unknown Role';
    }
}