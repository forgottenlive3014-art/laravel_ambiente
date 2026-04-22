<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalData;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener datos REALES de la base de datos
        $environmentalData = EnvironmentalData::all();
        
        // Si no hay datos en la BD, mostrar datos de ejemplo
        if ($environmentalData->isEmpty()) {
            $environmentalData = collect([
                (object)['department' => 'San Salvador', 'temperature' => 30.5, 'humidity' => 68, 'air_quality' => 'regular', 'co2_levels' => 420, 'recommendations' => 'Usar mascarilla en zonas concurridas'],
                (object)['department' => 'Santa Ana', 'temperature' => 28.0, 'humidity' => 72, 'air_quality' => 'buena', 'co2_levels' => 380, 'recommendations' => 'Aprovechar para actividades al aire libre'],
                (object)['department' => 'San Miguel', 'temperature' => 32.0, 'humidity' => 65, 'air_quality' => 'regular', 'co2_levels' => 410, 'recommendations' => 'Mantenerse hidratado y evitar el sol'],
                (object)['department' => 'La Libertad', 'temperature' => 29.0, 'humidity' => 78, 'air_quality' => 'buena', 'co2_levels' => 370, 'recommendations' => 'Ideal para visitar playas'],
            ]);
        }
        
        // Calcular promedios desde los datos reales
        $promedioTemperatura = round($environmentalData->avg('temperature'), 1);
        $promedioHumedad = round($environmentalData->avg('humidity'));
        
        // Contar calidad del aire
        $malas = $environmentalData->where('air_quality', 'mala')->count();
        $regulares = $environmentalData->where('air_quality', 'regular')->count();
        $buenas = $environmentalData->where('air_quality', 'buena')->count();
        
        if ($malas > $regulares && $malas > $buenas) {
            $calidadGeneral = 'Mala';
        } elseif ($regulares > $buenas) {
            $calidadGeneral = 'Regular';
        } else {
            $calidadGeneral = 'Buena';
        }
        
        // Departamento más afectado (con peor calidad)
        $peorCalidad = $environmentalData->where('air_quality', 'mala')->first();
        $departamentoCritico = $peorCalidad ? $peorCalidad->department : 'San Salvador';
        
        $highlights = [
            'promedio_temperatura' => $promedioTemperatura,
            'promedio_humedad' => $promedioHumedad,
            'calidad_aire_general' => $calidadGeneral,
            'departamento_mas_afectado' => $departamentoCritico
        ];
        
        $recommendations = [
            '🌡️ Altas temperaturas' => 'Mantenerse hidratado y evitar exposición solar entre 10am-2pm',
            '🌫️ Mala calidad del aire' => 'Usar mascarilla N95 en zonas urbanas',
            '💧 Humedad alta' => 'Mantener ambientes ventilados para evitar hongos',
            '🌳 Deforestación' => 'Participar en jornadas de reforestación',
            '🚗 Contaminación vehicular' => 'Usar transporte público o bicicleta',
            '🗑️ Manejo de residuos' => 'Separar y reciclar los desechos correctamente'
        ];
        
        return view('dashboard', compact('environmentalData', 'highlights', 'recommendations'));
    }
}