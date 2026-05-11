<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalData;

class DashboardController extends Controller
{
    public function index()
    {
        $environmentalData = EnvironmentalData::all();
        
        if ($environmentalData->isEmpty()) {
            $environmentalData = collect([
                (object)['department' => 'San Salvador', 'municipality' => 'San Salvador', 'temperature' => 30.5, 'humidity' => 68, 'air_quality' => 'regular', 'co2_levels' => 420, 'recommendations' => 'Usar mascarilla en zonas concurridas', 'record_date' => now()->toDateString()],
                (object)['department' => 'Santa Ana', 'municipality' => 'Santa Ana', 'temperature' => 28.0, 'humidity' => 72, 'air_quality' => 'buena', 'co2_levels' => 380, 'recommendations' => 'Aprovechar para actividades al aire libre', 'record_date' => now()->toDateString()],
                (object)['department' => 'San Miguel', 'municipality' => 'San Miguel', 'temperature' => 32.0, 'humidity' => 65, 'air_quality' => 'regular', 'co2_levels' => 410, 'recommendations' => 'Mantenerse hidratado y evitar el sol', 'record_date' => now()->toDateString()],
                (object)['department' => 'La Libertad', 'municipality' => 'Santa Tecla', 'temperature' => 29.0, 'humidity' => 78, 'air_quality' => 'buena', 'co2_levels' => 370, 'recommendations' => 'Ideal para visitar playas', 'record_date' => now()->toDateString()],
            ]);
        }
        
        return view('dashboard', compact('environmentalData'));
    }
}