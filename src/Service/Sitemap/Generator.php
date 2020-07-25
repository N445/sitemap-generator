<?php


namespace App\Service\Sitemap;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

class Generator extends Configuration
{
    /**
     * @var array
     */
    private $urls = [];
    
    public function __construct()
    {
        $this->client = new Client();
    }
    
    public function generate(string $baseurl)
    {
        $this->setBaseUrl($baseurl);
        
        $this->addUrl($this->getBaseUrl() . '/');
        
        $this->parseUrl($this->getBaseUrl() . '/');
        
        dump($this->getUrls());
    }
    
    private function parseUrl(string $url)
    {
        $crawler = new Crawler($this->client->get($url)->getBody()->getContents(), $this->getBaseUrl());
        $this->getLinks($crawler);
    }
    
    private function getLinks(Crawler $crawler)
    {
        /** @var Link $link */
        foreach ($crawler->filter('a')->links() as $link) {
            if ((!in_array($link->getUri(), $this->getUrls())) && (parse_url($link->getUri())['host'] === parse_url($this->getBaseUrl())['host'])) {
                $this->addUrl($link->getUri());
                $this->parseUrl($link->getUri());
            }
        }
    }
    
    /**
     * @return array
     */
    public function getUrls(): array
    {
        return $this->urls;
    }
    
    /**
     * @param string $url
     * @return Generator
     */
    public function addUrl(string $url)
    {
        $this->urls[] = $url;
        return $this;
    }
}