<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(__DIR__.'/countries.json'), true);
        $countrieses = json_decode(file_get_contents(__DIR__.'/countries_es.json'), true);

        foreach ($countries as $key=> $country) {
            if (!isset($country['flag'])) {
                $country['flag'] = 'default.png';
            }
            if (!isset($country['iso_3166_2'])) {
                $country['iso_3166_2'] = '';
            }
            if (!isset($country['calling_code'])) {
                $country['calling_code'] = '';
            }
            if (!isset($country['name'])) {
                $country['name'] = '';
            }

            $data = [
                'code'         => $country['iso_3166_2'],
                'flag'         => $country['flag'],
                'calling_code' => $country['calling_code'],
                'en'           => [
                    'name' => $country['name'],
                ],
                'es' => [
                    'name' => $countrieses[$key]['name'],
                ],

            ];
            Country::create($data);
        }
    }
}
