<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $environmentalData = $this->getEnvironmentalData();
        
        $highlights = [
            'promedio_temperatura' => 28.5,
            'promedio_humedad' => 75,
            'calidad_aire_general' => 'Moderada',
            'departamento_mas_afectado' => 'San Salvador'
        ];
        
        $recommendations = $this->getRecommendations();
        
        return view('dashboard', compact('environmentalData', 'highlights', 'recommendations'));
    }
    
    private function getEnvironmentalData()
    {
        return [
            (object)[
                'department' => 'San Salvador',
                'temperature' => 30.5,
                'humidity' => 68,
                'air_quality' => 'regular',
                'co2_levels' => 420,
                'recommendations' => 'Usar mascarilla al salir'
            ],
            (object)[
                'department' => 'Santa Ana',
                'temperature' => 28.0,
                'humidity' => 72,
                'air_quality' => 'buena',
                'co2_levels' => 380,
                'recommendations' => 'Aprovechar para actividades al aire libre'
            ],
            (object)[
                'department' => 'San Miguel',
                'temperature' => 32.0,
                'humidity' => 65,
                'air_quality' => 'regular',
                'co2_levels' => 410,
                'recommendations' => 'Mantenerse hidratado'
            ],
            (object)[
                'department' => 'La Libertad',
                'temperature' => 29.0,
                'humidity' => 78,
                'air_quality' => 'buena',
                'co2_levels' => 370,
                'recommendations' => 'Ideal para visitar playas'
            ],
            (object)[
                'department' => 'Usulután',
                'temperature' => 31.0,
                'humidity' => 70,
                'air_quality' => 'regular',
                'co2_levels' => 400,
                'recommendations' => 'Evitar quemas agrícolas'
            ],
            (object)[
                'department' => 'Sonsonate',
                'temperature' => 30.0,
                'humidity' => 75,
                'air_quality' => 'regular',
                'co2_levels' => 415,
                'recommendations' => 'Proteger fuentes de agua'
            ]
        ];
    }
    
    private function getRecommendations()
    {
        return [
            '🌡️ Altas temperaturas' => 'Mantenerse hidratado y evitar exposición solar entre 10am-2pm',
            '🌫️ Mala calidad del aire' => 'Usar mascarilla N95 en zonas urbanas',
            '💧 Humedad alta' => 'Mantener ambientes ventilados para evitar hongos',
            '🌳 Deforestación' => 'Participar en jornadas de reforestación',
            '🚗 Contaminación vehicular' => 'Usar transporte público o bicicleta',
            '🗑️ Manejo de residuos' => 'Separar y reciclar los desechos correctamente'
        ];
    }
}