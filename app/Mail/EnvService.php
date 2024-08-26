<?php

namespace App\Mail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class EnvService
{
    public function updateEnv($data = [])
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            foreach ($data as $key => $value) {
                // Busca si la clave ya existe en el archivo .env
                $pattern = "/^{$key}=.*$/m";
                if (preg_match($pattern, $envContent)) {
                    // Reemplaza la línea existente
                    $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
                } else {
                    // Añade una nueva línea si la clave no existe
                    $envContent .= "\n{$key}={$value}";
                }
            }

            File::put($envPath, $envContent);

            try {
                Artisan::call('config:clear');
                Artisan::call('cache:clear');
                Artisan::call('config:cache');
                Log::info('Config cache cleared successfully.');
            } catch (\Exception $e) {
                Log::error('Error clearing config cache: ' . $e->getMessage());
            }


        }
    }
}
