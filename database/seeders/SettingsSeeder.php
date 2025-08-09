<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Agence Immobilière Premium',
                'type' => 'string',
                'group' => 'general'
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@immobilier.com',
                'type' => 'string',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_phone',
                'value' => '01 23 45 67 89',
                'type' => 'string',
                'group' => 'contact'
            ],
            [
                'key' => 'address',
                'value' => "123 Rue de l'Immobilier\n75001 Paris, France",
                'type' => 'text',
                'group' => 'contact'
            ],
            [
                'key' => 'description',
                'value' => 'Votre partenaire de confiance pour tous vos projets immobiliers. Nous vous accompagnons dans l\'achat, la vente et la location de biens immobiliers.',
                'type' => 'text',
                'group' => 'general'
            ]
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
