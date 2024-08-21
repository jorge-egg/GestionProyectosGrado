<?php
namespace App\Services;

use Illuminate\Support\Facades\File;

class EnvService
{
    public function updateEnv($data = [])
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            foreach ($data as $key => $value) {
                $escaped = preg_quote('=' . env($key), '/');
                File::put(
                    $envPath,
                    preg_replace(
                        "/^{$key}{$escaped}/m",
                        "{$key}={$value}",
                        File::get($envPath)
                    )
                );
            }
        }
    }
}
