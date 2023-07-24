<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use mysql_xdevapi\Exception;
use App\Utils\DatesConfigure;

class WikipediaController extends Controller
{
    // make an api call to wikipedia with the day and month parameter
    public function getOnThisDay(Request $request, $month = null, $day = null)
    {
        $currentDate = now();                                //if there is no day and month parameters, use today date
        $month = $month ?? $currentDate->format('m');
        $day = $day ?? $currentDate->format('d');

        $cacheKey = "wikipedia_{$month}_{$day}";
        $cacheDuration = 60 * 24; // cache for 24 hours
try {                                                                                              // make the api requeset and return the relevant data
    $result['items'] = Cache::remember($cacheKey, $cacheDuration, function () use ($month, $day) {
        $url = "https://api.wikimedia.org/feed/v1/wikipedia/en/onthisday/selected/{$month}/{$day}";
        $response = Http::withOptions([
            'verify' => false
        ])->get($url);

        $data = $response->json()['selected'];

        $result = [];

        foreach ($data as $item) {
            $pages = $item['pages'];

            if ($pages) {
                foreach ($pages as $page)
                    $result[] = [
                        'year' => $item['year'],
                        'link' => $page['content_urls']['desktop']['page'],
                        'title' => $page['titles']['normalized'],
                        'thumbnail' => $page['thumbnail']['source'] ??
                            'https://upload.wikimedia.org/wikipedia/commons/6/63/Wikipedia-logo.png?20140817194256',
                        'text' => $item['text']
                    ];
            }
        }
        return $result;
    });
    $result['month'] = $month;
    $result['day'] = $day;
    $next_and_previous = new DatesConfigure();                                          //get the next and previous date
    $result['next_previous_date'] = $next_and_previous->getNextPreviousDate($month, $day);

    return response()->json($result);
}
catch (Exception $e){
    return $e->getMessage();
    }
    }

}
