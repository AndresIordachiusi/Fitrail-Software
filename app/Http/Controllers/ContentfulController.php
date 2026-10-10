<?php

namespace App\Http\Controllers;
use Contentful\Delivery\Client;
use Contentful\Delivery\Query;


use Illuminate\Http\Request;

class ContentfulController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function headers() // header es el content type en Contentful
    {

        $entry = $this->client->getEntry('40iIE44KVD7zRfy6fkbkxm');
        $headerBienvenida = $this->client->getEntry('1x4CsWnoMEVoHpct94RV6G');

        $query = new Query();
        $query->setContentType('planes');
        $planes = $this->client->getEntries($query);
        $entrenamientos = $this->client->getEntries(new Query(['content_type' => 'entrenamientos']));

        return view('homepage.index', compact('entry', 'headerBienvenida', 'planes', 'entrenamientos'));
    }
}
