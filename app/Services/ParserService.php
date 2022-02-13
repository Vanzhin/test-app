<?php

namespace App\Services;

use App\Contracts\Parser;
use \Laravie\Parser\Document;
use Orchestra\Parser\Xml\Facade as XMLParser;

class ParserService implements Parser
{

    private Document $document;

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link): Parser
    {
        $this->document = XMLParser::load($link);
        return $this;
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        dd($this->document->getContent());
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
                'uses' => 'channel.item[title, link, guid, description, pubDate]'
            ],

        ]);
    }
}
