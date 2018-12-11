<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class HomeController extends Controller
{
    private function parse($posts) {
        $parsed = [];

        foreach($posts as $post){
            $relevantInfo = [];
            $relevantInfo['user'] = $post['user']['name'];
            $relevantInfo['text'] = $post['text'];
            $relevantInfo['url'] = '';

            if (count($post['entities']['urls']) > 0) {
                $relevantInfo['url'] = $post['entities']['urls'][0]["url"];
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

        return json_decode((string) $response->getBody(), true)['statuses'];
    }

    public function show(Request $data) {
        $query = $data->all()['query'];

        $result = $this->twitterSearch($query);

        $parsed = $this->parse($result);

        return view('index', [
            'messages' => $parsed
        ]);
    }
}
