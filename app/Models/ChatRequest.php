<?php

namespace App\Models;

use App\Events\ChatRequestSent;
use App\Exceptions\ChatRequestException;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use App\Services\Parsers\RealEstateParserFactory;
use Illuminate\Support\Facades\Blade;

class ChatRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'request_text',
        'styles',
        'temperature',
        'max_tokens',
        'presence_penalty',
        'frequency_penalty',
    ];

    protected $casts = [
        'styles' => 'json',
        'temperature' => 'float',
        'max_tokens' => 'integer',
        'presence_penalty' => 'float',
        'frequency_penalty' => 'float',
    ];
    
    protected $attributes = [
        'styles' => '[]',
    ];

    public function send($uri, $style = '')
    {
        $ai = new OpenAi(env('OPENAI_API_KEY'));
        
        $request = $this->request($uri, $style);
        $response = $ai->chat($request);
        $response = json_decode($response, true);

        ChatRequestSent::dispatch(Auth::user(), $uri, $style);

        if (isset($response['error'])) {
            throw new ChatRequestException($response['error']['message']);
        }

        return nl2br($response['choices'][0]['message']['content']);
    }

    private function request($uri, $style)
    {;
        $request['model'] = $this->model;
        $request['messages'][] = [
            'role' => 'system', 
            'content' => $this->getStyleText($style) ?? '', 
        ];
        $request['messages'][] = [
            'role' => 'user', 
            'content' => $this->requestText($uri),
        ];
        $request['temperature'] 
            = $this->temperature;
        $request['max_tokens'] 
            = $this->max_tokens;
        $request['presence_penalty'] 
            = $this->presence_penalty;
        $request['frequency_penalty'] 
            = $this->frequency_penalty;

        return $request;
    }

    private function requestText($uri): string
    {        
        $parser = RealEstateParserFactory::build();
        $details = $parser->propertyDetails($uri);
        
        $requestText = Blade::render($this->request_text, [
            'uri' => $uri,
            'ba' => $details['ba'],
            'bd' => $details['bd'],
            'schools' => array_reduce($details['schools'], function ($schools, $school) {
                $schools .= "{$school['name']}({$school['rating']}), ";
                return $schools;
            })
        ]);

        return $requestText;
    }

    private function getStyleText($styleName): string|null
    {
        foreach ($this->styles as $style) {
            if ($styleName == $style['name']) {
                return $style['text'];
            }
        }

        return null;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
