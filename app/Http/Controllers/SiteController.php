<?php

namespace App\Http\Controllers;

use App\Contracts\UrlShortenerContract;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    private Site $siteModel;

    /**
     * Create a new controller instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->siteModel = $site;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crawledSites = $this->siteModel->all();

        return view('sites.index',compact('crawledSites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param UrlShortenerContract $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UrlShortenerContract $urlShortener)
    {
        // we should move this validation to a form request and validate that is a valid url, make sanitization
        $request->validate(['long_url' => 'required']);

        $long_url = $request->get('long_url');

        $site = $this->siteModel->firstOrCreate([
            'long_url' => $long_url
        ]);

        if ($site->short_url !== null){
            return redirect()->route('sites.index')
                ->with('success','Url already shorted.');
        }

        $site->short_url = $urlShortener->shortUrl($long_url, $site->id);

        try {
            $site->saveOrFail();
        } catch (\Throwable $exception){
            return redirect()->route('sites.index')
                ->with('error', $exception->getMessage());
        }

        return redirect()->route('sites.index')
            ->with('success','Url shorted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return redirect()->route('sites.index')
            ->with('success','Site deleted successfully');
    }
}
