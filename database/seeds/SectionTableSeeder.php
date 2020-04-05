<?php

use App\Unit;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SectionNames = [
            'Бренд позиционирование',
            'Рыночные и финансовые цели',
            'Орг структура', 'ДНК', 'Дорожная карта',
            'Системы', 'Аналитика', 'Клиентский ряд',
            'Бизнес-модель', 'Страт Гант'
        ];

        $icon_codes = [
            'fas fa-copyright', 'fas fa-crosshairs',
            'fas fa-bezier-curve', 'fas fa-dna',
            'fas fa-map-marked-alt', 'fas fa-sitemap',
            'fas fa-chart-line', 'fas fa-users-cog',
            'fab fa-phabricator','fas fa-chart-bar'
        ];

        $units = Unit::all();
        foreach ($units as $unit) {
            foreach ($SectionNames as $k=>  $oneName) {
                $type = $oneName === 'Системы' ? 'system' : 'attachment';
                factory(\App\Section::class)->create([
                    'name' => $oneName,
                    'bu_id' => $unit->id,
                    'icon_code' =>$icon_codes[$k],
                    'type' => $type
                ]);
            }
        }
    }
}
