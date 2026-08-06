<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class DeploymentController extends Controller
{
    public function deploy(Request $request)
    {
        $secret = env('DEPLOYMENT_SECRET');

        // Check if the secret is configured and matches the request token
        if (!$secret || $request->input('token') !== $secret) {
            Log::warning('Unauthorized deployment attempt.');
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Wait 5 seconds to ensure Hostinger's Git auto-pull has finished
            // before we run migrations on the potentially new files.
            sleep(5);

            // Run migrations forcefully
            Artisan::call('migrate', ['--force' => true]);
            $migrateOutput = Artisan::output();

            // Clear and rebuild caches
            Artisan::call('optimize:clear');
            $optimizeClearOutput = Artisan::output();
            
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');

            Log::info('Deployment automation completed successfully.');

            return response()->json([
                'status' => 'success',
                'migrate_output' => $migrateOutput,
                'optimize_output' => $optimizeClearOutput
            ]);
        } catch (\Exception $e) {
            Log::error('Deployment automation failed: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
