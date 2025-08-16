<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StaffProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']); // hanya admin boleh akses
    }

    public function index()
    {
        $staffs = StaffProfile::with('user')->paginate(15);
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|max:2048',
            'jabatan' => 'nullable|string|max:255',
        ]);

        // create user (role = staff)
        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : Hash::make('password'),
            'role' => 'staff',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('staff_photos', 'public');
        }

        StaffProfile::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
            'foto' => $fotoPath,
            'jabatan' => $data['jabatan'] ?? null,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function show(StaffProfile $staffProfile)
    {
        $staffProfile->load('user');
        return view('admin.staff.show', ['staff' => $staffProfile]);
    }

    public function edit(StaffProfile $staffProfile)
    {
        return view('admin.staff.edit', ['staff' => $staffProfile]);
    }

    public function update(Request $request, StaffProfile $staffProfile)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$staffProfile->user_id,
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|max:2048',
            'jabatan' => 'nullable|string|max:255',
        ]);

        // update user email/name/password if needed
        $user = $staffProfile->user;
        $user->name = $data['nama'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        if ($request->hasFile('foto')) {
            // delete old if exists
            if ($staffProfile->foto) {
                Storage::disk('public')->delete($staffProfile->foto);
            }
            $staffProfile->foto = $request->file('foto')->store('staff_photos', 'public');
        }

        $staffProfile->nama = $data['nama'];
        $staffProfile->jabatan = $data['jabatan'] ?? null;
        $staffProfile->save();

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy(StaffProfile $staffProfile)
    {
        // Hapus file foto jika ada
        if ($staffProfile->foto) {
            Storage::disk('public')->delete($staffProfile->foto);
        }

        // Hapus user (cascade) atau hapus profile + user manual
        $user = $staffProfile->user;
        $staffProfile->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil dihapus.');
    }
}
