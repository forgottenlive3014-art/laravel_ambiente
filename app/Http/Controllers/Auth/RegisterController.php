<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $municipios = $this->getMunicipiosElSalvador();
        return view('auth.register', compact('municipios'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'municipio' => ['required', 'string'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'municipio' => $request->municipio,
            'role' => 'user'
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    private function getMunicipiosElSalvador()
    {
        return [
            'San Salvador' => ['San Salvador', 'Mejicanos', 'Soyapango', 'Santa Tecla', 'Ilopango', 'Apopa'],
            'Santa Ana' => ['Santa Ana', 'Metapán', 'Chalchuapa', 'El Congo'],
            'San Miguel' => ['San Miguel', 'Chapeltique', 'Moncagua', 'Ciudad Barrios'],
            'La Libertad' => ['Santa Tecla', 'La Libertad', 'Zaragoza', 'Nueva San Salvador', 'Quezaltepeque'],
            'Usulután' => ['Usulután', 'Berlín', 'Jiquilisco', 'Puerto El Triunfo'],
            'Sonsonate' => ['Sonsonate', 'Acajutla', 'Izalco', 'Nahuizalco'],
            'La Paz' => ['Zacatecoluca', 'San Pedro Masahuat', 'Santiago Nonualco'],
            'Cuscatlán' => ['Cojutepeque', 'Suchitoto', 'San Rafael Cedros'],
            'La Unión' => ['La Unión', 'Conchagua', 'Santa Rosa de Lima'],
            'Morazán' => ['San Francisco Gotera', 'Torola', 'Jocoro'],
            'Ahuachapán' => ['Ahuachapán', 'Atiquizaya', 'Tacuba'],
            'Chalatenango' => ['Chalatenango', 'Nueva Concepción', 'La Palma'],
            'Cabañas' => ['Sensuntepeque', 'Ilobasco', 'Victoria'],
            'San Vicente' => ['San Vicente', 'Apastepeque', 'San Sebastián']
        ];
    }
}