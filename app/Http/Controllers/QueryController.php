<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class QueryController extends Controller
{
    private function parse($posts) {
        $parsed = [];

        foreach($posts as $post){
            $relevantInfo = [];
            $relevantInfo['name'] = $post['user']['name'];
            $relevantInfo['body'] = $post['text'];
            $relevantInfo['link'] = '';

            if (count($post['entities']['urls']) > 0) {
                $relevantInfo['link'] = $post['entities']['urls'][0]["url"];
            } 

            $parsed[] = $relevantInfo;
        }

        return $parsed;
    }

    private function twitterSearch($query) {
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->request('GET', 'https://api.twitter.com/1.1/search/tweets.json?q=' . urlencode($query) . '&lang=pt&result_type=recent', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('TWITTER_API_RECENT_BEARER')
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            return false;
        }

        return json_decode((string) $response->getBody(), true)['statuses'];
    }

    public function query() {
        $tags = array_map(function ($tag) {
            return $tag['body'];
        }, auth()->user()->tags->toArray());
        
        $tags = implode(' ', $tags);

        $result = $this->twitterSearch($tags);

        if (! $result) {
            return response()->json([
                'message' => 'Falha em executar procura no Twitter'
            ], 400);
        }

        $parsed = $this->parse($result);

        foreach($parsed as $post) {
            \App\Message::create([
                'user_id' => auth()->id(),
                'name' => $post['name'],
                'body' => $post['body'],
                'link' => $post['link']
            ]);
        }

        return response()->json($parsed, 200);
    }
}
