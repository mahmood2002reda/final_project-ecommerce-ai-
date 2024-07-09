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
//use SergiX44\Gradio\Client;
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
    
        $productImagePath = public_path('images/product/' . $product->model_image);
    
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
                        'filename' => $product->model_image,
                    ]
                ],
                'headers' => [
                    'X-RapidAPI-Host' => 'virtual-try-on2.p.rapidapi.com',
                    'X-RapidAPI-Key' => '0d198b0c26msh2f96992eb3e8b4ap1d2f08jsn6a63d17fe774',
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
     
        $url = 'https://levihsu-ootdiffusion.hf.space/call/process_hd';
        $response = Http::post($url, [
            'data' => [
                [
                    'vton_img' => 'https://levihsu-ootdiffusion.hf.space/file=/tmp/gradio/2e0cca23e744c036b3905c4b6167371632942e1c/model_1.png',
                    'garm_img' => 'https://levihsu-ootdiffusion.hf.space/file=/tmp/gradio/180d4e2a1139071a8685a5edee7ab24bcf1639f5/03244_00.jpg',
                    'n_samples' => 1,
                    'n_steps' => 20,
                    'image_scale' => 2,
                    'seed' => -1,
                    'api_name' => '/process_hd'
                ]
            ]
        ]);

        $result = $response->json();

        return response()->json($result);
        
    }
    public function readFile(Request $request)
    {
        // Retrieve the file path from the request
        $filePath = $request->input('filePath');
    
        if ($filePath && Storage::disk('temp_files')->exists($filePath)) {
            $content = Storage::disk('temp_files')->get($filePath);
            $mimeType = Storage::disk('temp_files')->mimeType($filePath);
            
            return response($content)->header('Content-Type', $mimeType);
        } else {
            return response("File does not exist.", 404);
        }
    }
    

    }

    
    

