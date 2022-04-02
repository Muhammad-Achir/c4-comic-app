<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Home | Web Programming',
            'point' => ['satu', 'sepuluh', 'delapan']
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'tittle' => 'About Me'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'tittle' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Polewali Mandar',
                    'provinsi' => 'Sulawesi Barat'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Gowa',
                    'provinsi' => 'Sulawesi Selatan'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
