<?php

namespace App\Http\Middleware;

use Sellout\IoLog;
use Closure;
use Request;

class IoLogResponseMiddleware
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
        if(env('IO_LOG') !== true) return $next($request);
        $response = $next($request);
        $rinput = $request->all();

        if(isset($rinput['file']) && class_basename($rinput['file']) === 'UploadedFile')
        {
            $file['originalName'] = $rinput['file']->getClientOriginalName();
            $file['mimeType'] = $rinput['file']->getClientMimeType();
            $file['size'] = $rinput['file']->getClientSize();
            $file['error'] = $rinput['file']->getError();
            $file['isValid'] = $rinput['file']->isValid();
            $rinput['file'] = $file;
        }
        $rjson = false;
        if(class_basename($request->json()) === 'ParameterBag')
        {
            $rjson = $request->json()->all();
        }
        $log = [
            'io_log_type' => 'response',
            'request_method' => $request->method(),
            'request_url' => $request->fullUrl(),
            'request_ip' => $request->ip(),
            'request_header' => $request->header(),
            'request_server' => $request->server(),
            'request_raw' => $request->__toString(),
            'request_input_parsed' => $rinput,
            'request_input_json' => $rjson,
            'response_header' => $response->headers->all(),
            'response_status' => $response->status(),
            'response_content' => $response->content(),
        ];
        IoLog::create($log);
        return $response;
    }
}
