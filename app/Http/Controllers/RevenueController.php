<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revenues = Revenue::orderBy('revenue_date', 'desc')->paginate(10);
        return view('revenues.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('revenues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'revenue_date' => 'required|date',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        Revenue::create($validatedData);

        return redirect()->route('revenues.index')->with('success', 'Entrada registrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        return view('revenues.show', compact('revenue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        return view('revenues.edit', compact('revenue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'revenue_date' => 'required|date',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $revenue->update($validatedData);

        return redirect()->route('revenues.index')->with('success', 'Entrada atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();
        return redirect()->route('revenues.index')->with('success', 'Entrada excluída com sucesso!');
    }
}