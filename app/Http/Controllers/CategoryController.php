<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahan: Import Auth untuk cek role

class CategoryController extends Controller
{
    public function index()
    {
        //PROTEKSI: Jika bukan admin, langsung block!
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Anda bukan Admin.');
        }

        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        //PROTEKSI: Jika bukan admin, langsung block!
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Anda bukan Admin.');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        //PROTEKSI: Jika bukan admin, langsung block!
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Anda bukan Admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }
}