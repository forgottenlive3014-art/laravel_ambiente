<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnvironmentalDataController extends Controller{
    public function index()
    {
        $datos = EnvironmentalData::all();
        return view('admin.index', compact('datos'));
    }
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        return view('admin.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $request->validate([
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'temperature' => 'required|numeric|min:-20|max:50',
            'humidity' => 'required|integer|min:0|max:100',
            'air_quality' => 'required|in:buena,regular,mala',
            'co2_levels' => 'required|numeric|min:0',
            'recommendations' => 'required|string',
            'record_date' => 'required|date'
        ]);

        EnvironmentalData::create([
            'department' => $request->department,
            'municipality' => $request->municipality,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'air_quality' => $request->air_quality,
            'co2_levels' => $request->co2_levels,
            'recommendations' => $request->recommendations,
            'record_date' => $request->record_date
        ]);

        return redirect()->route('admin.environmental.index')
            ->with('success', 'Dato ambiental creado exitosamente');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        $dato = EnvironmentalData::findOrFail($id);
        return view('admin.edit', compact('dato'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $request->validate([
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'temperature' => 'required|numeric|min:-20|max:50',
            'humidity' => 'required|integer|min:0|max:100',
            'air_quality' => 'required|in:buena,regular,mala',
            'co2_levels' => 'required|numeric|min:0',
            'recommendations' => 'required|string',
            'record_date' => 'required|date'
        ]);

        $dato = EnvironmentalData::findOrFail($id);
        $dato->update([
            'department' => $request->department,
            'municipality' => $request->municipality,
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'air_quality' => $request->air_quality,
            'co2_levels' => $request->co2_levels,
            'recommendations' => $request->recommendations,
            'record_date' => $request->record_date
        ]);

        return redirect()->route('admin.environmental.index')
            ->with('success', 'Dato ambiental actualizado exitosamente');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $dato = EnvironmentalData::findOrFail($id);
        $dato->delete();

        return redirect()->route('admin.environmental.index')
            ->with('success', 'Dato ambiental eliminado exitosamente');
    }
}