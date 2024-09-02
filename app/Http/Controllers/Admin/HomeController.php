<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Blog;
use GuzzleHttp\Client;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data["userData"] = $this->getVisitorLocation($request);
        $data["visits"] = $this->getVisitorRecords(7);
        $data["popularPosts"] = Cache::remember("popularPosts", 300, function () {
            return Blog::orderByDesc("view_count")->limit(6)->get();
        });
        $data["infoLogs"] = $this->getLogRecords("info");
        $data["errorLogs"] = $this->getLogRecords("errors");
        return view(themeView("admin", "index"), $data);
    }

    public function cacheClear()
    {
        Cache::flush();
        return redirect()->back()->withSuccess(__('admin/general.cache_clear_success'));
    }

    public function clearVisitorCounter()
    {
        try {
            Cache::forget("visits");
            Visitor::truncate();
            return back()->withSuccess(__('admin/home.visitor_counter_clear_success'));
        } catch (Exception $e) {
            return back()->withError(__('admin/home.visitor_counter_clear_error'));
        }
    }

    private function getVisitorRecords(int $day)
    {
        return Cache::remember("website_statistics", 300, function () use ($day) {
            $visits = Visitor::all();
            $data = [
                "todaySingleVisits" => $visits->where("updated_at", ">", today())->count(),
                "totalSingleVisits" => $visits->count(),
                "totalPageViews" => $visits->sum("visit_count"),
                "chart" => [
                    "singleVisits" => [],
                    "uniqueVisits" => [],
                    "dates" => []
                ]
            ];
            for ($i = $day - 1; $i >= 0; $i--) {
                $startDay = today()->subDays($i);
                $endDay = today()->subDays($i - 1);
                $data["chart"]["singleVisits"][] = $visits->whereBetween("updated_at", [$startDay, $endDay])->count();
                $data["chart"]["uniqueVisits"][] = $visits->whereBetween("created_at", [$startDay, $endDay])->count();
                $data["chart"]["dates"][] = strtotime($startDay) * 1000;
            }
            return $data;
        });
    }

    private function getVisitorLocation(Request $request)
    {
        $client = new Client();
        $response = $client->get("ipinfo.io/" . $request->ip() . "?token=1a17407b2ccf6f");
        return json_decode($response->getBody());
    }

    private function getLogRecords($file)
    {
        $file = storage_path('logs/custom_' . $file . '.log');
        if (File::exists($file)) {
            $records = array_reverse(array_filter(explode("\n", File::get($file)), function ($line) {
                return !empty($line);
            }));
        } else {
            $records = [];
        }
        return $records;
    }
}
