<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function dashboardBackgroundUrl()
    {
        $settingsPath = storage_path('app/background-settings.json');

        if (!file_exists($settingsPath)) {
            return null;
        }

        $settings = json_decode(file_get_contents($settingsPath), true);
        if (!is_array($settings)) {
            return null;
        }

        if (!empty($settings['background_file'])) {
            return asset('storage/' . $settings['background_file']);
        }

        return $settings['background_url'] ?? null;
    }
}
