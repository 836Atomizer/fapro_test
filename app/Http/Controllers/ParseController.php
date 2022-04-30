<?php

namespace App\Http\Controllers;

use App\Models\Parse;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ParseController extends Controller
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $array;
    /**
     * @var mixed
     */
    private $url_web;
    /**
     * @var mixed
     */
    private $url_endpoint;

    public function __construct(){
        /* Initializing / Goutte*/
        $this->client = new Client();
        $this->array = [];
        $this->url_web = 'https://www.sii.cl/servicios_online/1047-nomina_inst_financieras-1714.html';
        $this->url_endpoint = 'https://www.sii.cl/servicios_online/1047-nomina_inst_financieras-1714.csv?_=1651278690564';
    }

    public function index()
    {
        /* Header web */
        $title = $this->client->request('GET',$this->url_web);
        $title = $title->filter('p')->text();
        $info = Arr::add($this->array, 'title', $title);
        /* Table */
        $rest = Http::get($this->url_endpoint);
        $arrays = array_map('str_getcsv', explode(PHP_EOL, $rest));
        /* Join arrays */
        $json = Arr::collapse([$info,$arrays]);
        return $json_send = json_encode($json);


        /*
         * Examples deprecated using Guzzle
         * */
        /*$request = new Client([
            'base_uri' => 'https://www.sii.cl',
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => [
                '_' => '1651180901416'
            ]
        ]);
        $request = $request->request('GET','servicios_online/1047-nomina_inst_financieras-1714.csv');
        $body = json_decode($request->getBody()->getContents());
        dd($body);*/

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parse  $parse
     * @return \Illuminate\Http\Response
     */
    public function show(Parse $parse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parse  $parse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parse $parse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parse  $parse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parse $parse)
    {
        //
    }
}
