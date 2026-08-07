<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed WMP Admin User
        User::updateOrCreate(
            ['email' => 'admin@wmpcreative.com'],
            [
                'name' => 'WMP Admin',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // 2. Seed WMP Customer User
        User::updateOrCreate(
            ['email' => 'user@wmpcreative.com'],
            [
                'name' => 'WMP Client User',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        // 3. Seed Default Storefront Products
        Product::updateOrCreate(
            ['name' => 'Aura Creative Agency Portfolio Template'],
            [
                'description' => 'Sleek, fully responsive portfolio website template customized using Bootstrap 5 and smooth animations.',
                'category' => 'UI Templates',
                'price' => 29.00,
                'preview_image' => 'images/logo.png',
                'download_file' => 'downloads/aura_agency_portfolio_v1.zip'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Apex High-Fidelity Bootstrap Component Library'],
            [
                'description' => 'Luxury layout structures, clean custom forms, sidebars, cards, and buttons designed directly in HTML/CSS.',
                'category' => 'UI Components',
                'price' => 49.00,
                'preview_image' => 'images/logo.png',
                'download_file' => 'downloads/apex_ui_library_v2.zip'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'WMP Brand Guidelines & Vector Pack'],
            [
                'description' => 'Premium templates and scalable files containing icons, presentation layouts, and agency guidelines.',
                'category' => 'Graphics & Vectors',
                'price' => 19.00,
                'preview_image' => 'images/logo.png',
                'download_file' => 'downloads/wmp_brand_guidelines.zip'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Veloce Laravel SaaS Boilerplate'],
            [
                'description' => 'Pre-configured Laravel application starter kit with clean DB support, login scaffolding, and Bootstrap theme.',
                'category' => 'Code Scripts',
                'price' => 79.00,
                'preview_image' => 'images/logo.png',
                'download_file' => 'downloads/veloce_laravel_boilerplate.zip'
            ]
        );
    }
}
