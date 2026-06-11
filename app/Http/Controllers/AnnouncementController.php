<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // === SISI USER / MAHASISWA ===
    
    public function index() 
    {
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function show($id) 
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.detail', compact('announcement'));
    }

    // === SISI ADMIN / STAF KAMPUS ===

    public function adminDashboard() 
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Anda bukan Admin.');
        }

        $announcements = Announcement::latest()->get();
        return view('announcements.admin', compact('announcements'));
    }

    public function create() 
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }
        return view('announcements.create');
    }

    public function store(Request $request) 
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori' => 'required',
        ]);

        Announcement::create($request->only(['judul', 'isi', 'kategori']));

        return redirect()->route('announcements.admin')->with('success', 'Pengumuman berhasil diterbitkan!');
    }

    // --- FITUR TAMBAHAN: EDIT & HAPUS ---

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak!');
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak!');
        
        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        return redirect()->route('announcements.admin')->with('success', 'Pengumuman berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }

        Announcement::findOrFail($id)->delete();

        return redirect()->route('announcements.admin')->with('success', 'Pengumuman berhasil dihapus!');
    }
}