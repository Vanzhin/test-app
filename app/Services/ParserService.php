<?php

namespace App\Services;

use App\Contracts\Parser;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use \Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{

    private Document $document;

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link): Parser
    {
        $this->document = XmlParser::load($link);
        return $this;
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        return
            $this->document->parse([
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
    }

    public function saveToDb($links)
    {
        foreach ($links as $link){
            $data= $this->setLink($link)->parse();
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
                    return true;
                } else{
                    return false;
                }
            }
        }
    }
}
