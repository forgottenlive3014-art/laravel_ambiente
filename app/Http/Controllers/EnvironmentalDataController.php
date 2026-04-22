<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnvironmentalDataController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        $datos = EnvironmentalData::all();
        return view('admin.index', compact('datos'));
    }
    
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        return view('admin.create');
    }
    
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        
        $request->validate([
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'humidity' => 'required|integer',
            'air_quality' => 'required|string',
            'co2_levels' => 'required|numeric',
            'recommendations' => 'required|string',
            'record_date' => 'required|date'
        ]);
        
        EnvironmentalData::create($request->all());
        return redirect()->route('admin.environmental.index')->with('success', 'Dato ambiental creado exitosamente');
    }
    
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        $dato = EnvironmentalData::findOrFail($id);
        return view('admin.edit', compact('dato'));
    }
    
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        
        $request->validate([
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'temperature' => 'required|numeric',
            'humidity' => 'required|integer',
            'air_quality' => 'required|string',
            'co2_levels' => 'required|numeric',
            'recommendations' => 'required|string',
            'record_date' => 'required|date'
        ]);
        
        $dato = EnvironmentalData::findOrFail($id);
        $dato->update($request->all());
        return redirect()->route('admin.environmental.index')->with('success', 'Dato ambiental actualizado exitosamente');
    }
    
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos de administrador');
        }
        
        $dato = EnvironmentalData::findOrFail($id);
        $dato->delete();
        return redirect()->route('admin.environmental.index')->with('success', 'Dato ambiental eliminado exitosamente');
    }
}