<?php

namespace Sellout;

use Sellout\Base;

class IoLog extends Base
{
    protected $table = 'io_logs';

    protected $casts = [
        'request_header' => 'array',
        'request_server' => 'array',
        'request_input_parsed' => 'array',
        'request_input_json' => 'array',
        'response_header' => 'array',
    ];

    protected $fillable = [
        'mid',
        'request_method',
        'request_url',
        'request_ip',
        'request_header',
        'request_server',
        'request_raw',
        'request_input_parsed',
        'request_input_json',
        'response_header',
        'response_status',
        'response_content',
        'io_log_type'
    ];
}
