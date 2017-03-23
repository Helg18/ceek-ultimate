<?php

namespace Ceek\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CeekMidAdapterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $return = $next($request);
        if($return instanceof JsonResponse)
        {
            $data = $return->getData(true);
            $return->setData($this->_addMongo_id($data));
        }
        // if($return instanceof Response)
        // {
        //     $data = $return->getContent();
        //     $return->setContent($this->_addMongo_id($data));
        // }
        return $return;
    }
    private function _addMongo_id($data)
    {
        foreach($data as $k => &$v)
        {
            if(is_array($v))
            {
                $v = $this->_addMongo_id($v);
            }
            else if($k === 'mid')
            {
                $data['_id'] = $v;
            }
        }
        return $data;
    }
}
