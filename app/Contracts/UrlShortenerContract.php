<?php

namespace App\Contracts;

interface UrlShortenerContract
{
    public function shortUrl(string $long_url, int $id): string;
    public function expandUrl(string $short_url): string;
}
