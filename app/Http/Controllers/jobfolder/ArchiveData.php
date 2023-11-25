<?php

namespace App\Http\Controllers\jobfolder;

use App\Http\Controllers\Controller;
use App\Models\ArticleContent;
use App\Models\ArchiveArticle;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ArchiveData extends Controller
{
    public function Archive()
    {
        // Retrieve data older than 6 months
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $dataToMove = ArticleContent::where('created_at', '<', $sixMonthsAgo)->get();

        // Move data to archived table
        ArchiveArticle::insert($dataToMove->toArray());

        // delete data 
        ArticleContent::where('created_at', '<', $sixMonthsAgo)->delete();
    }
}
