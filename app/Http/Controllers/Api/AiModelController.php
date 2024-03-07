<?php

namespace App\Http\Controllers\Api;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AiModelController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://virtual-try-on2.p.rapidapi.com/clothes-virtual-tryon', [
    'multipart' => [
        [
           
            'name' => 'personImage',
            'filename' => 'Man-PNG-Free-Download.png',
            'contents' => fopen(__DIR__ . '/Man-PNG-Free-Download.png', 'r'),
            'headers' => [
                'Content-Type' => 'application/octet-stream'
            ]
        ],
        [
            'name' => 'clothImage',
            'filename' => 'IMG-20240227-WA0003.jpg',
            'contents' => fopen(__DIR__ . '/IMG-20240227-WA0003.jpg', 'r'),
            'headers' => [
                'Content-Type' => 'application/octet-stream'
            ]
        ]
    ],
    'headers' => [
        'X-RapidAPI-Host' => 'virtual-try-on2.p.rapidapi.com',
        'X-RapidAPI-Key' => 'af291c8a60msh1e4a89650f69c8bp1a2ca5jsn1c33536c6af1',
    ],
]);

echo $response->getBody();
    }


   
 

public function test()
{
    // Get the image file from the URL
    $imageFile = file_get_contents('https://raw.githubusercontent.com/gradio-app/gradio/main/test/test_files/bus.png');
    
    // Save the image file to local storage
    $filename = 'bus.png';
    Storage::put($filename, $imageFile);
    
    // Create a GuzzleHttp client
    $client = new Client([
        'verify' => 'c:/wamp64/bin/php/php8.1.0/cacert.pem', // Update this path to where you saved the cacert.pem file
    ]);
    
    // Send the POST request to the analysis endpoint
    $response = $client->request('POST', 'https://ootd.ibot.cn/process_dc', [
        'multipart' => [
            [
                'name' => 'model',
                'contents' => fopen(storage_path('app/' . $filename), 'r'),
                'filename' => $filename
            ],
            [
                'name' => 'garment',
                'contents' => fopen(storage_path('app/' . $filename), 'r'),
                'filename' => $filename
            ],
            [
                'name' => 'images',
                'contents' => '1'
            ],
            [
                'name' => 'steps',
                'contents' => '20'
            ],
            [
                'name' => 'guidance_scale',
                'contents' => '1'
            ],
            [
                'name' => 'seed',
                'contents' => '-1'
            ],
        ]
    ]);

    // Get the analysis result from the response
    $result = $response->getBody()->getContents();
    
    // Display the analysis result
    echo $result;
}



public function processHd()
{
    
    // إجراء طلب POST مع تجاوز مشكلة شهادة SSL
    $response = Http::withOptions([
        'verify' => 'c:\\wamp64\\bin\\php\\php8.1.0\\cacert.pem' // تحديد موقع ملف cacert.pem
    ])->post('https://ootd.ibot.cn/', [
        'model' => fopen(__DIR__ . '/Man-PNG-Free-Download.png', 'r'),
        'garment' =>fopen(__DIR__ . '/IMG-20240227-WA0003.jpg', 'r'),
        'images' => 1,
        'steps' => 20,
        'guidance_scale' => 1,
        'seed' => -1,
    ]);

    // معالجة الاستجابة
    if ($response->successful()) {
        $result = $response->json();
        print_r($result);
    } else {
        // معالجة الخطأ
        echo "Error: " . $response->body();
    }
}


public function processDc()
{
    $response = Http::post('https://ootd.ibot.cn/process_dc', [
        'model' => __DIR__ . '/Man-PNG-Free-Download.png', 'r',
        'garment' =>__DIR__ . '/IMG-20240227-WA0003.jpg', 'r',
        'garment_category' => 'Upper-body', // Ensure this matches the expected values ('Upper-body', 'Lower-body', 'Dress')
        'images' => 1,
        'steps' => 20,
        'guidance_scale' => 1,
        'seed' => -1,
    ]);

    if ($response->successful()) {
        $result = $response->json();
        print_r($result);
    } else {
        // Handle error
        echo "Error: " . $response->body();
    }
}


    }

