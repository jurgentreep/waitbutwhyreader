<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Goutte\Client;

use Cache;

use \stdClass;

class ScrapeController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Show article
     * @return view
     */
    public function index($year, $month, $page)
    {
        $base_url = 'http://waitbutwhy.com/';
        $url = $base_url . $year . '/' . $month . '/' . $page;
        $article = $this->getArticle($url);
        return view('pages.article', compact('article'));
    }

    /**
     * Retrieve the article from a url
     * @param  String     $url
     * @return Object
     */
    private function getArticle($url)
    {
        if(Cache::has($url)) {
            $article = Cache::get($url);
        } else {
            $crawler = $this->client->request('GET', $url);
            $article = new stdClass();
            $article = $this->extractArticle($crawler);
            $minutes = 1440;
            Cache::put($url, $article, $minutes);
        }

        return $article;
    }

    /**
     * Extract all the usefull information from the article
     * @param  Object $crawler
     * @return Object
     */
    private function extractArticle($crawler)
    {
        $article = new stdClass();
        $article->title = $crawler->filter('.entry-header h1')->text();
        $article->author = $crawler->filter('.entry-meta')->text();
        $article->paragraphs = $crawler->filter('.entry-content>p')->each(function ($node) {
            $html = $node->html();
            if ($node->filter('img')->count()) {
                $html = '<img src="' . $node->filter('img')->attr('src') . '">';
            }
            return $html;
        });
        $article->footnotes = new stdClass();
        $article->footnotes->extra_info = $crawler->filter('.footnote')->each(function ($node) {
            $footnote = $this->generateFootnote($node);
            return $footnote;
        });
        $article->footnotes->citations_sources = $crawler->filter('.footnote2')->each(function ($node) {
            $footnote = $this->generateFootnote($node);
            return $footnote;
        });

        return $article;
    }

    /**
     * Generate an html string that represents the footnote
     * @param  Object $node
     * @return string
     */
    private function generateFootnote($node)
    {
        $id = $node->attr('id');
        $html = $node->filter('p')->html();
        $footnote = '<li id="' . $id . '">' . $html . '</li>';
        return $footnote;
    }
}
