<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class ImageGeneratorController extends Controller
{


    public function downloadImage(Request $request)
    {
        $imageUrl = $request->input('imageUrl');

        // Fetch the image content
        $imageContent = Http::get($imageUrl)->body();

        // Encode the image content in Base64
        $base64Image = base64_encode($imageContent);

        return response()->json(['image' => $base64Image]);
    }
    public function ImageGenerator(Request $request)
    {
        //$request come from the parameter of imageGenerator it use for getting data from the form
        //input is like $_POST['choices] in the php
        // choices is the variable name
        //apikey is for the api key
    $apikey = 'vk9ViouMyADtELYUQ8zcdm8m2YckWY8sIIN0R5B7Cq6CMPJxPFk7tngHmXNq';
            $prompt = $request->input('prompt');
            $count = $request->input('count');
            $width = $request->input('width');
            $height = $request->input('height');
            $guidance = $request->input('guidance');
            $step = $request->input('step');
            $client = new Client;

            $response = $client->post('https://stablediffusionapi.com/api/v3/text2img',[
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' =>
                [
                "key" => $apikey,
                "prompt" => $prompt,
                "negative_prompt" => "painting, extra fingers, mutated hands, poorly drawn hands, poorly drawn face, deformed, ugly, blurry, bad anatomy, bad proportions, extra limbs, cloned face, skinny, glitchy, double torso, extra arms, extra hands, mangled fingers, missing lips, ugly face, distorted face, extra legs, anime,nude",
                "width" => $width,
                "height" => $height,
                "samples" => $count,
                "num_inference_steps" => $step,
                "safety_checker" => "no",
                "enhance_prompt" => "yes",
                "seed" => null,
                "guidance_scale" => $guidance,
                "multi_lingual" => "no",
                "panorama" => "no",
                "self_attention" => "no",
                "upscale" => "yes",
                "embeddings_model" => null,
                "webhook" => null,
                "track_id" => null
                ],
            ]);

            $responsedata = json_decode($response->getBody(),true);
            $responsedata['message'] = 'Successfully '. 'prompt' . $prompt  . 'count:' . $count . 'height:' . $height . 'width:' . $width . 'guidance:' . $guidance . 'step:' . $step;
            return response()->json($responsedata);





    }

    public function ImageGeneratorUsingSpeech(Request $request)
    {
        //$request come from the parameter of imageGenerator it use for getting data from the form
        //input is like $_POST['choices] in the php
        // choices is the variable name
        //apikey is for the api key
    $apikey = 'vk9ViouMyADtELYUQ8zcdm8m2YckWY8sIIN0R5B7Cq6CMPJxPFk7tngHmXNq';
            $speech = $request->input('speechText');
            $count = $request->input('count');
            $width = $request->input('width');
            $height = $request->input('height');
            $guidance = $request->input('guidance');
            $step = $request->input('step');
            $client = new Client;

            $response = $client->post('https://stablediffusionapi.com/api/v3/text2img',[
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' =>
                [
                "key" => $apikey,
                "prompt" => $speech,
                "negative_prompt" => "painting, extra fingers, mutated hands, poorly drawn hands, poorly drawn face, deformed, ugly, blurry, bad anatomy, bad proportions, extra limbs, cloned face, skinny, glitchy, double torso, extra arms, extra hands, mangled fingers, missing lips, ugly face, distorted face, extra legs, anime,nude",
                "width" => $width,
                "height" => $height,
                "samples" => $count,
                "num_inference_steps" => $step,
                "safety_checker" => "no",
                "enhance_prompt" => "yes",
                "seed" => null,
                "guidance_scale" => $guidance,
                "multi_lingual" => "no",
                "panorama" => "no",
                "self_attention" => "no",
                "upscale" => "yes",
                "embeddings_model" => null,
                "webhook" => null,
                "track_id" => null
                ],
            ]);

            $responsedata = json_decode($response->getBody(),true);
            $responsedata['message'] = 'Successfully '. 'speech-text:' . $speech  . 'count:' . $count . 'height:' . $height . 'width:' . $width . 'guidance:' . $guidance . 'step:' . $step;
            return response()->json($responsedata);





    }
    public function generateVideo(Request $request)
    {
        $apikey = 'vk9ViouMyADtELYUQ8zcdm8m2YckWY8sIIN0R5B7Cq6CMPJxPFk7tngHmXNq';
        $prompt = $request -> input('prompt');
        $width = $request->input('width');
        $height = $request->input('height');
        $second = $request->input('second');
        $step = $request->input('step');
        $guidance = $request->input('guidance');
        $client = new Client;

        $response = $client -> post('https://stablediffusionapi.com/api/v5/text2video',[
            'header' => [
                'Content-Type' => 'application/json',
            ],
            'json' =>
            [
                "key" => $apikey,
                "prompt" => 'dog running in the beach',
                "width" => 512,
                "height" => 512,
                "negative_prompt" => "Low Quality,watermark,blurred",
                "scheduler" => "UniPCMultistepScheduler",
                "num_inference_steps" => 11,
                "guidance_scale" => 7.5,
                "seconds" => 5
            ],
        ]);

        $responsedata = json_decode($response->getBody(),true);
        return response()->json($responsedata);
    }


    public function image_to_image(Request $request)
    {
        $apikey = 'vGPXFxdJLdfedDuNbSYhFE34UOnDMf9ETRMMUarInfpoiFO9v4qNF0AnlPHW';
        $prompt = $request->input('prompt');
        $count = $request->input('count');
        $width = $request->input('width');
        $height = $request->input('height');
        $guidance = $request->input('guidance');
        $step = $request->input('step');
        $image_file = $request->input('imagefile');
        $client = new Client;

        $response = $client->post('https://stablediffusionapi.com/api/v3/text2img',[
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' =>
            [
                "key" => $apikey,
                "prompt" => $prompt,
                "negative_prompt" => "ugly, tiling, poorly drawn hands, poorly drawn feet, poorly drawn face, out of frame, extra limbs, disfigured, deformed, body out of frame, bad anatomy, watermark, signature, cut off, low contrast, underexposed, overexposed, bad art, beginner, amateur, distorted face, blurry, draft, grainy",
                "init_image" => $image_file,
                "width" => $width,
                "height" => $height,
                "samples" => $count,
                "num_inference_steps" => $step,
                "safety_checker" => "no",
                "enhance_prompt" => "yes",
                "guidance_scale" => $guidance,
                "strength" => 0.7,
                "seed" => null,
                "webhook" => null,
                "track_id" => null
            ],
        ]);

        $responsedata = json_decode($response->getBody(),true);
        $responsedata = json_decode($response->getBody(),true);
        return response()->json($responsedata);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
