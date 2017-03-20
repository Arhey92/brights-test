<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;

class HomeController
{
    public function index()
    {
        $all = Action::all();

        $data = [
            'data' => $all
        ];

        return view('index', $data);
    }

    public function postUrls(Request $request)
    {
        $urls = explode("\r\n", $request->input('url-container'));

        foreach($urls as $key => $url){
            $title = $this->getTitle($url);
            $statusCode = $this->getContent($url);

            $viewData[$key] = [
                'title' => $title,
                'status' => $statusCode,
                'url' => $url
            ];

            $action = new Action();
            $action->create($title, $statusCode, $url);
        }

        return redirect()->back();
    }

    function getTitle($url) {
        $data = file_get_contents($url);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
        return $title;
    }

    function getContent($domain)
    {
        if(!filter_var($domain, FILTER_VALIDATE_URL))
        {
            return false;
        }

        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER, true);


        curl_exec($curlInit);
        $info = curl_getinfo($curlInit);

        curl_close($curlInit);

        return $info['http_code'];
    }

    public function getStatistics()
    {
        $info = Action::all();

        $data = [
            'data' => $info
        ];

        return view('statistics', $data);
    }

    public function showChart($id)
    {
        $currentUrl = Action::where('id', '=', $id)->first();
        $urls = Action::where('url', '=', $currentUrl->url)->get();

        foreach($urls as $url){
            $dates[$url->id] = date("d", strtotime($url->created_at));
        }

        $count = array_count_values($dates);
        $uniqueDates = array_unique($dates);

        $data = [
            'requests' => $count,
            'charts' => $uniqueDates,
            'title' => $currentUrl->title
        ];

        return view('chart', $data);
    }
}