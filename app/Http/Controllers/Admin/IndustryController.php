<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::latest()->get();

        return view('admin.industry.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industry.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('industry', 'public');
        }

        Industry::create($data);

        return redirect()->route('admin.industry.index')
            ->with('success','Industry berhasil ditambahkan');
    }
}