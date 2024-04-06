<?php

namespace App\Http\Controllers\Api;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Scalar\MagicConst\Dir;

class AiModelController extends Controller
{

    public function index(Request $request, $id)
{
    $productId = $request->route('id');
    $product = Product::find($productId);

    $personalImage = $request->file('personalImage');

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    if (!$personalImage) {
        return response()->json(['error' => 'Personal image not provided'], 400);
    }

    $productImagePath = public_path('images/product/' . $product->image);

    // Save the personal image to a temporary location
    $personalImage->move(public_path('images/temp'), $personalImage->getClientOriginalName());
    $personImagePath = public_path('images/temp/' . $personalImage->getClientOriginalName());

    $client = new Client();

    try {
        $response = $client->request('POST', 'https://virtual-try-on2.p.rapidapi.com/clothes-virtual-tryon', [
            'multipart' => [
                [
                    'name' => 'personImage',
                    'contents' => fopen($personImagePath, 'r'),
                    'filename' => $personalImage->getClientOriginalName(),
                ],
                [
                    'name' => 'clothImage',
                    'contents' => fopen($productImagePath, 'r'),
                    'filename' => $product->image,
                ]
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'virtual-try-on2.p.rapidapi.com',
                'X-RapidAPI-Key' => 'c5a14fac7fmsha88d8a3d5711c4dp16a47ajsn195bc9cb5bdc',
            ],
        ]);

        // Remove the temporary personal image file
        fclose(fopen($personImagePath, 'r'));
        unlink($personImagePath);

        return response()->json(json_decode($response->getBody(), true));
    } catch (\Exception $e) {
        // Remove the temporary personal image file in case of an error
        fclose(fopen($personImagePath, 'r'));
        unlink($personImagePath);

        return response()->json(['error' => 'Request failed: ' . $e->getMessage()], 500);
    }
}


   
 

public function processHD(Request $request)
{
    $this->httpClient = new Client(['verify' => false]);
    $imageUrl = 'https://raw.githubusercontent.com/gradio-app/gradio/main/test/test_files/bus.png';

    // Adjust the API endpoint as necessary based on the documentation
    $apiEndpoint = 'https://levihsu-ootdiffusion.hf.space/--replicas/e0nbp/'; // Example adjustment

    try {
        // Perform image analysis
        $imageAnalysis = "The image appears to be a red bus with a smiley face drawn on it. The bus is likely a part of a promotional or marketing campaign, as it features a cheerful design. The image does not provide any information about the bus's route or destination, but it is clear that the bus is the main focus of the image.";

        // Make API request to the correct endpoint
        $response = $this->httpClient->get($apiEndpoint, [
            'multipart' => [
                [
                    'name' => 'image1',
                    'contents' => fopen($imageUrl, 'r'),
                    'filename' => basename($imageUrl),
                ],
                // Include other parameters as required by the API
            ],
        ]);

        return response()->json([
            'image_analysis' => $imageAnalysis,
            'api_response' => json_decode($response->getBody()->getContents(), true),
        ]);
    } catch (Exception $e) {
        // Handle the error and provide an appropriate response
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

private function downloadImage($url)
{
    $contents = file_get_contents($url);
    $name = basename($url);
    $path = sys_get_temp_dir() . '/' . $name;
    file_put_contents($path, $contents);

    return $path;
}

public function processDc(Request $request)
{
    $apiEndpoint = "https://levihsu-ootdiffusion.hf.space/--replicas/e0nbp/process_dc"; 
    
    $client = new Client();

    try {
        $response = $client->get($apiEndpoint, [
            'json' => [
                'model' => 'https://raw.githubusercontent.com/gradio-app/gradio/main/test/test_files/bus.png',
                'garment' => 'https://raw.githubusercontent.com/gradio-app/gradio/main/test/test_files/bus.png',
                'garment_category' => "Upper-body",
                'images' => 1,
                'steps' => 20,
                'guidance_scale' => 1,
                'seed' => -1,
            ]
        ]);

        // Decode the JSON response
        $result = json_decode($response->getBody(), true);
        return response()->json($result);
    } catch (\Exception $e) {
        // Handle any errors
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    }

