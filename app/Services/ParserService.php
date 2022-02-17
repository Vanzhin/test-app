<?php

namespace App\Services;

use App\Contracts\Parser;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{

    private Document $document;
    private string $link;

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link): Parser
    {
        $this->document = XmlParser::load($link);
        $this->link = $link;
        return $this;
    }

    /**
     * @return array
     */
    public function parse()
    {

            $data = $this->document->parse([
            'title' =>[
                'uses' => 'channel.title'
            ],
            'link' =>[
                'uses' => 'channel.link'
            ],
            'description' =>[
                'uses' => 'channel.description'
            ],
            'image' =>[
                'uses' => 'channel.image.url'
            ],
            'news' =>[
                'uses' => 'channel.item[title,link,guid,description,pubDate,image]'
            ],
        ]);

        return $data;
//        $encode = json_encode($data);
//        $explode = explode('/', $this->link);
//        $parseLink = end($explode);
//        Storage::disk('public')->append('parsing/'. $parseLink, $encode);
    }

    public function saveToDb($data)
    {

            foreach ($data['news'] as $news){
                $parsed = News::query()->firstOrCreate([
                    'title' => $news['title'],
                    'slug' => Str::slug($news['title']),
                    'author' => $data['title'],
                    'status' => 'draft',
                    'description' => $news['description'],
                    'image' => $news['image'],

                ]);
                if ($parsed){
                    $category = Category::query()->firstOrCreate([
                        'title' => $data['title'],
                        'description' => $data['description'],
                    ]);
                    $parsed->categories()->attach($category->id);
                }
            }
    }
}
