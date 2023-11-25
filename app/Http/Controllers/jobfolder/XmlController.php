<?php

namespace App\Http\Controllers\jobfolder;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Vedmant\FeedReader\Facades\FeedReader;
use App\Models\source;
use App\Models\ArticleContent;

class XmlController extends Controller
{
    public function importXML()
    {
        $sources_arr = source::get();

        foreach ($sources_arr as $source) {
            // Define the XML file URL
            $f = FeedReader::read($source->url);

            foreach ($f->get_items(0, $f->get_item_quantity()) as $item) {

                // Insert the data into the database
                $dataSource = [
                    'source_id' => $source->id,
                    'publish_date' => $item->get_date(),
                ];
                $Artical = Article::create($dataSource);

                // Store the element attributes in an associative array
                $data = [
                    'article_id' => $Artical->id,
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'link' => $item->get_link(),
                    'image' => $item->get_permalink(),
                    'video' => $item->get_thumbnail(),
                ];
                // Insert the data into the database
                DB::table('article_contents')->insert($data);
            }
        }
        return response()->json('suceess', 200);
    }
}
