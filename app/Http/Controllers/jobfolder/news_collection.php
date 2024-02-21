<?php

namespace App\Http\Controllers\jobfolder;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Vedmant\FeedReader\Facades\FeedReader;
use App\Models\source;
use App\Models\ArticleContent;

class news_collection extends Controller
{
    public function importXML()
    {
        $sources_arr = source::get();

        foreach ($sources_arr as $source) {

            if (strpos($source->url, 'https://www.youm7.com/') !== false) {
                
                $url = $source->url;
                echo ($url);
                $f = FeedReader::read($url);
                $pageSource = $f->getRawContent();

                foreach ($pageSource->get_items(0, $pageSource->get_item_quantity()) as $item) {
                    // Insert the data into the database
                    $dataSource = [
                        'source_id' => $source->id,
                        'publish_date' => $item->get_date(),
                    ];
                    $Artical = Article::create($dataSource);

                    // Store the element attributes in an associative array
                    $data = [
                        'article_id' => $Artical->id,
                        'title' => $item->get_title() ?? $item->get_author(),
                        'description' => $item->get_description(),
                        'link' => $item->get_link(),
                        'image' => $item->get_permalink(),
                        'video' => $item->get_permalink(),
                    ];
                    // Insert the data into the database
                    DB::table('article_contents')->insert($data);

                    ArticleCategory::create([
                        'article_id' => $Artical->id,
                        'category_id' => $source->category_id,
                        'subcategory_id' => $source->subcategory_id,
                    ]);
                }

            } else {
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
                        'title' => $item->get_title() ?? $item->get_author(),
                        'description' => $item->get_description(),
                        'link' => $item->get_link(),
                        'image' => $item->get_permalink(),
                        'video' => $item->get_thumbnail(),
                    ];
                    // Insert the data into the database
                    DB::table('article_contents')->insert($data);

                    ArticleCategory::create([
                        'article_id' => $Artical->id,
                        'category_id' => $source->category_id,
                        'subcategory_id' => $source->subcategory_id,
                    ]);
                }
            }

        }
        return response()->json('suceess', 200);
    }
}
