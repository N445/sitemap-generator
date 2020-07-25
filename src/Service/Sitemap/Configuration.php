<?php


namespace App\Service\Sitemap;


class Configuration
{
    /**
     * @var string
     */
    private $baseUrl;
    
    /**
     * regex pattern
     * @var array
     */
    private $blacklist = [];
    
    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
    
    /**
     * @param string $baseUrl
     * @return Configuration
     */
    public function setBaseUrl(string $baseUrl): Configuration
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getBlacklist(): array
    {
        return $this->blacklist;
    }
    
    /**
     * @param array $blacklist
     * @return Configuration
     */
    public function setBlacklist(array $blacklist): Configuration
    {
        $this->blacklist = $blacklist;
        return $this;
    }
    
    /**
     * @param string $blacklist
     * @return Configuration
     */
    public function addBlacklist(string $blacklist): Configuration
    {
        $this->blacklist[] = $blacklist;
        return $this;
    }
    
    
}