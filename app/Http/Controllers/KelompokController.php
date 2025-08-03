<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKelompokRequest;
use App\Http\Requests\UpdateKelompokRequest;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelompok::with(['anggotas'])
            ->withCount('anggotas');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kelompok', 'like', "%{$search}%")
                  ->orWhere('ketua_kelompok', 'like', "%{$search}%");
            });
        }

        $kelompoks = $query->latest()->paginate(10);

        return Inertia::render('kelompok/index', [
            'kelompoks' => $kelompoks,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('kelompok/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelompokRequest $request)
    {
        $kelompok = Kelompok::create($request->validated());

        return redirect()->route('kelompok.show', $kelompok)
            ->with('success', 'Kelompok berhasil didaftarkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelompok $kelompok)
    {
        $kelompok->load([
            'anggotas' => function ($query) {
                $query->with('pinjamen');
            },
            'pinjamen.anggota'
        ]);

        return Inertia::render('kelompok/show', [
            'kelompok' => $kelompok,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelompok $kelompok)
    {
        return Inertia::render('kelompok/edit', [
            'kelompok' => $kelompok,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelompokRequest $request, Kelompok $kelompok)
    {
        $kelompok->update($request->validated());

        return redirect()->route('kelompok.show', $kelompok)
            ->with('success', 'Data kelompok berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelompok $kelompok)
    {
        $kelompok->delete();

        return redirect()->route('kelompok.index')
            ->with('success', 'Kelompok berhasil dihapus.');
    }
}