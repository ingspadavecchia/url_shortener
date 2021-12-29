<?php

namespace App\Services;


use App\Contracts\UrlShortenerContract;

class UrlShortener implements UrlShortenerContract
{
    private string $dictionary  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    private int $base  = 62;

    /**
     * function to shorten the long url
     *
     * @param string $long_url
     * @return string
     */
    public function shortUrl(string $long_url, int $id): string
    {
        if($id === 0){
            return $this->dictionary[0];
        }

        $short = '';

        //-- convert the mysql id of the long url from base 10 to base 62 and make alphanumeric --//
        do
        {
            $short = $this->dictionary[($id % $this->base)] . $short;
        }
        while ($id = floor($id/$this->base));

        return $short;
    }

    /**
     * function to decode the short url
     *
     * @param string $short_url
     * @return int
     */
    public function decodeUrl(string $short_url): int
    {
        //-- decode the short string to base 62 and convert to base 10 id --//
        $id = 0;
        while($len = strlen($short_url))
        {
            $id += strpos($this->dictionary, $short_url[0]);
            $id *= $len > 1 ? $this->base : 1;
            $short_url = substr($short_url, 1);
        }

        return $id;
    }
}
