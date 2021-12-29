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
     * function to expand the short url
     *
     * @param string $short_url
     * @return string
     */
    public function expandUrl(string $short_url): string
    {
        //-- decode the short string to base 62 and convert to base 10 id --//
        $id = 0;
        while($len = strlen($short_url))
        {
            $id += strpos($this->dict, $short_url[0]);
            $id *= $len > 1 ? $this->base : 1;
            $short_url = substr($short_url, 1);
        }

        //-- make sure long url pertaining to the decoded mysql id exists --//
        $url_does_exist = mysql_query("SELECT long_url FROM urls WHERE id=$id");

        //-- if it does, return the long url --//
        if (mysql_num_rows($url_does_exist))
        {
            $row = mysql_fetch_object($url_does_exist);
            return $row->long_url;
        }
        else
        {
            return FALSE;
        }
    }
}
