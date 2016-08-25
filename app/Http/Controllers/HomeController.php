<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Goutte\Client;

use Cache;

use \stdClass;

class HomeController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $article = new stdClass();
        $article = $this->getHomePage();
        return view('home', compact('article'));
    }

    private function getHomePage()
    {
        // Cache::forget('homepage_list');
        if(Cache::has('homepage_list')) {
            $article = Cache::get('homepage_list');
        } else {
            $article = new StdClass();
            $crawler = $this->client->request('GET', 'http://waitbutwhy.com/archive');
            $article->title = 'Wait But Why';
            $article->list = $crawler->filter('.post-list li')->each(function ($node) {
                $item = new stdClass();
                $item->title = str_replace('http://waitbutwhy.com', url('/'), $node->filter('.post-right h5')->html());
                $item->image = '<img src="' . $node->filter('.thumbnail img')->attr('src') . '">';
                return $item;
            });
            $minutes = 1440;
            Cache::put('homepage_list', $article, $minutes);
        }
        return $article;
    }
}
