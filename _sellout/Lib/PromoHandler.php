<?php

namespace Sellout;

use Sellout\Promo;
use Sellout\PromoCode;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class PromoHandler
{
    private $headers = [
        'Accept' => 'application/json',
        'deviceid' => 'sellout-api'
    ];
    private $client;
    private $params;
    private $token = [
        'id'     => false,
        'device' => false
    ];
    private $requiresToken;

    public function __construct(Array $params = [])
    {
        $this->params = $params;
    }
    public function index()
    {

    }
    public function show()
    {

    }
    public function invalidate()
    {

    }
    public function delete()
    {

    }
    public function resolvePromoCode($code)
    {
        return PromoCode::where('code', '=', $code)->first();
    }
    public function create()
    {
        $json = $this->params;
        if(isset($json['codes'])) unset($json['codes']);
        if(isset($json['name'])) unset($json['name']);
        if(isset($json['description'])) unset($json['description']);
        $verb = 'post';
        $path = '/v1/project';
        $json = [
            'name' => $this->name,
            'description' => $this->description,
            'definition' => $json
        ];
        $this->requiresToken = true;
        $response = $this->_http($verb, $path, $json);
        $project = $this->_parseResponse($response);
        $this->promo = $this->_storePromo($project);
        $checkout = $this->_checkoutCodes();
        $codes = $this->_fetchCodes();
        $this->codes = $this->_storeCodes($codes);
        return [$this->promo, $this->codes];
    }
    private function _connectToCogen()
    {
        if($this->_needsClient()) $this->_instanceClient();
        if($this->_needToGetToken()) $this->_addHeaderCredentials();
    }
    private function _storeCodes(Array $codes = [])
    {
        $now = \Carbon\Carbon::now();
        $promoCodes = [];
        foreach($codes as $i => $code)
        {
            $promoCodes[$i]['code'] = $code;
            $promoCodes[$i]['promo_id'] = $this->promo->id;
            $promoCodes[$i]['team_id'] = $this->promo->team_id;
            $promoCodes[$i]['created_at'] = $now;
            $promoCodes[$i]['updated_at'] = $now;
        }
        PromoCode::insert($promoCodes);
        return PromoCode::where('promo_id', '=', $this->promo->id)->get();
    }
    private function _fetchCodes()
    {
        $verb = 'get';
        $path = '/v1/checkout/codes';
        $header = ['project' => $this->promo->project_id];
        $this->requiresToken = true;
        $response = $this->_http($verb, $path, null, $header);
        return $this->_parseResponse($response);
    }
    private function _checkoutCodes()
    {
        $verb = 'post';
        $path = '/v1/checkout';
        $json = [
            'project_id' => $this->promo->project_id,
            'numberOfCodes' => $this->codes
        ];
        $this->requiresToken = true;
        $response = $this->_http($verb, $path, $json);
        return $this->_parseResponse($response);
    }
    private function _parseDefinition($definition)
    {
        $decoded = json_decode($definition, true);
        return $decoded;
    }
    private function _storePromo($project)
    {
        $promo = [
            'project_id' => $project->id,
            'team_id' => $project->team_id,
            'name' => $project->name,
            'description' => $project->description,
            'admin_invalidated' => false,
            'cogen_updated_at' => $project->updated_at,
            'cogen_created_at' => $project->created_at
        ];
        $promo = array_merge($promo, $this->_parseDefinition($project->definition));
        return Promo::create($promo);
    }
    private function _parseResponse($response)
    {
        if($response->getStatusCode() !== 200)
        {
            return abort($response->getStatusCode(), 'Cogen error: '. $response->getMessage());
        }
        return json_decode($response->getBody()->getContents());
    }
    private function _addHeaderCredentials()
    {
        if($this->requiresToken && $this->_needToGetToken())
        {
            $response = $this->_getNewToken();
            $this->headers['token'] = $response->token_id;
        }
        $this->headers['team'] = $this->_getTeam();
    }
    private function _getNewToken()
    {
        $verb = 'POST';
        $path = '/v1/session';
        $json = [
            'email' => $this->_getKey(),
            'password' => $this->_getSecret()
        ];
        $this->requiresToken = false;
        $response = $this->_http($verb, $path, $json);
        if($response->getStatusCode() !== 200)
        {
            return abort(400, 'Unable to authenticate with Cogen.');
        }
        return json_decode($response->getBody()->getContents());
    }
    private function _http($verb, $path, $json, Array $headers = [])
    {
        if(strtoupper($verb) === 'GET' && strtoupper($verb) === 'POST')
        {
            throw new Exception("Unsupported HTTP verb: ".$verb, 1);
        }
        $this->_connectToCogen();
        $response = false;
        $headers = array_merge($this->headers, $headers);
        if(strtoupper($verb) === 'POST')
        {
            $response = $this->client->request('POST', $path, [
                'headers' => $headers,
                'json' => $json
            ]);
        }
        elseif(strtoupper($verb) === 'GET')
        {
            $response = $this->client->request('GET', $path, [
                'headers' => $headers
            ]);
        }
        return $response;
    }
    private function _instanceClient()
    {
        if($this->_needsClient())
        {
            $base = 'http://' . $this->_getHost();
            $this->client = new Client([
                'base_uri' => $base
            ]);
        }
        return;
    }
    private function _getHost()
    {
        return env('COGEN_HOST');
    }
    private function _getKey()
    {
        return env('COGEN_KEY');
    }
    private function _getSecret()
    {
        return env('COGEN_SECRET');
    }
    private function _getTeam()
    {
        return env('COGEN_TEAM');
    }
    private function _needToGetToken()
    {
        return (!isset($this->headers) || !isset($this->headers['token']) || is_null($this->headers['token']));
    }
    private function _needsClient()
    {
        return (!isset($this->client) || is_null($this->client));
    }
    public function __get($var)
    {
        return isset($this->params[$var])
            ? $this->params[$var]
            : null;
    }
}
