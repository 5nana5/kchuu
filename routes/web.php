<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Kategori;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});



/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {

        // =========================
        // DATA PRODUK & KATEGORI
        // =========================

        $produks = Produk::with('kategori')
            ->latest()
            ->get();

        $kategoris = Kategori::with('produks')
            ->latest()
            ->get();


        // =========================
        // BACKGROUND DASHBOARD
        // =========================

        $backgroundUrl = null;

        $settingsPath = storage_path('app/background-settings.json');

        if (file_exists($settingsPath)) {

            $settings = json_decode(
                file_get_contents($settingsPath),
                true
            ) ?: [];

            // Background upload local
            if (!empty($settings['background_file'])) {

                $backgroundUrl = asset(
                    'storage/' . $settings['background_file']
                );

            }

            // Background URL internet
            elseif (!empty($settings['background_url'])) {

                $backgroundUrl = $settings['background_url'];

            }

        }


        // =========================
        // RETURN VIEW DASHBOARD
        // =========================

        return view('dashboard', compact(
            'produks',
            'kategoris',
            'backgroundUrl'
        ));

    })->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | RESOURCE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::resource('kategori', KategoriController::class);

    Route::resource('produk', ProdukController::class);



    /*
    |--------------------------------------------------------------------------
    | BACKGROUND CUSTOMIZER
    |--------------------------------------------------------------------------
    */

    Route::post('/dashboard/background', function (Request $request) {

        $request->validate([

            'background_image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'background_url' =>
                'nullable|url',

        ]);


        // =========================
        // LOAD FILE SETTINGS
        // =========================

        $settingsPath = storage_path(
            'app/background-settings.json'
        );

        $settings = file_exists($settingsPath)

            ? json_decode(
                file_get_contents($settingsPath),
                true
            )

            : [];

        $settings = is_array($settings)
            ? $settings
            : [];


        // =========================
        // RESET BACKGROUND
        // =========================

        if ($request->input('action') === 'reset') {

            if (!empty($settings['background_file'])) {

                Storage::disk('public')->delete(
                    $settings['background_file']
                );

            }

            file_put_contents(
                $settingsPath,
                json_encode([])
            );

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Latar belakang berhasil direset.'
                );

        }


        // =========================
        // UPLOAD GAMBAR
        // =========================

        if ($request->hasFile('background_image')) {

            // Hapus background lama
            if (!empty($settings['background_file'])) {

                Storage::disk('public')->delete(
                    $settings['background_file']
                );

            }

            // Simpan gambar baru
            $path = $request->file('background_image')
                ->store('backgrounds', 'public');

            $settings = [

                'background_file' => $path,

                'background_url' => null

            ];

        }


        // =========================
        // BACKGROUND VIA URL
        // =========================

        elseif ($request->filled('background_url')) {

            // Hapus file lama
            if (!empty($settings['background_file'])) {

                Storage::disk('public')->delete(
                    $settings['background_file']
                );

            }

            $settings = [

                'background_file' => null,

                'background_url' => $request->background_url

            ];

        }


        // =========================
        // VALIDASI KOSONG
        // =========================

        else {

            return back()->withErrors([

                'background_image' =>
                    'Unggah gambar atau masukkan link gambar.'

            ]);

        }


        // =========================
        // SIMPAN SETTINGS
        // =========================

        file_put_contents(
            $settingsPath,
            json_encode($settings)
        );


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Latar belakang berhasil diperbarui.'
            );

    })->name('dashboard.background');



    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});



/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';