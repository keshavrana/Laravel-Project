<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class AiController extends Controller
{
    public function openaiview()
    {
        return view('ai.openaiview');
    }

    public function airesult(Request $request)
    {
        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $topic = $request->topic;

        $propt = "Create 5 fake news topic about " . $topic;

        $complete = $open_ai->completion([
            'model' => 'davinci-instruct-beta-v3',
            'prompt' => $propt,
            'temperature' => 0.9,
            'max_tokens' => 150,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        $decode = json_decode($complete, true);
        $data = $decode['choices'][0]['text'];
        return view('ai.openaiview', compact('data', 'topic'));
    }

    public function ajaxopenai()
    {
        return view('ai.ajaxopenaiview');
    }
    public function ajaxaireq(Request $request)
    {
        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $topic = $request->topic;

        $propt = $topic;

        $complete = $open_ai->completion([
            'model' => 'davinci-instruct-beta-v3',
            'prompt' => $propt,
            'temperature' => 0.9,
            'max_tokens' => 150,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        $decode = json_decode($complete, true);
        $org_data = $decode['choices'][0]['text'];
        return response()->json([
            'status' => 200,
            'org_data' => $org_data
        ]);
    }

    public function testing(){
        return view('ai.test');
    }
}
