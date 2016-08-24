<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Goutte\Client;

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

    public function getHomePage()
    {
        $article = new StdClass();
        $crawler = $this->client->request('GET', 'http://waitbutwhy.com/archive');
        $article->title = 'Wait But Why';
        $article->list = $crawler->filter('.post-list li')->each(function ($node) {
            $item = new stdClass();
            $item->title = str_replace('waitbutwhy.com', 'waitbutwhyreader.com', $node->filter('.post-right h5')->html());
            $item->image = '<img src="' . $node->filter('.thumbnail img')->attr('src') . '">';
            return $item;
        });

        // $article->page->message = $crawler->filter('.homeMessage')->html();
        // $article->page->main_post = new StdClass();
        // $article->page->main_post->title = $crawler->filter('.mainPost h1')->html();
        // $article->page->main_post->image = '<img src="' . $crawler->filter('.mainPost img')->attr('src') . '">';
        // $article->page->main_post->excerpt = $crawler->filter('.mainPost .entry-excerpt')->html();
        return $article;
    }
}
