<?php

namespace App\Enum;

final class HttpCode
{

    const HTTP_CODE_OK = 200;
    const HTTP_CODE_OK_EMPTY = 201;
    const HTTP_CODE_ACCEPTED = 202;
    const HTTP_CODE_NON_AUTHORITATIVE = 203;
    const HTTP_CODE_NO_CONTENT = 204;
    const HTTP_CODE_RESET_CONTENT = 205;
    const HTTP_CODE_PARTIAL_CONTENT = 206;
    const HTTP_CODE_MULTI_STATUS = 207;
    const HTTP_CODE_ALREADY_REPORTED = 208;
    const HTTP_CODE_IM_USED = 226;

    const HTTP_CODE_MULTIPLE_CHOICES = 300;
    const HTTP_CODE_MOVED_PERMANENTLY = 301;
    const HTTP_CODE_FOUND = 302;
    const HTTP_CODE_SEE_OTHER = 303;
    const HTTP_CODE_NOT_MODIFIED = 304;
    const HTTP_CODE_USE_PROXY = 305;
    const HTTP_CODE_UNUSED = 306;
    const HTTP_CODE_TEMPORARY_REDIRECT = 307;
    const HTTP_CODE_PERMANENT_REDIRECT = 308;

    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_UNAUTHORIZED = 401;
    const HTTP_CODE_PAYMENT_REQUIRED = 402;
    const HTTP_CODE_FORBIDDEN = 403;
    const HTTP_CODE_NOT_FOUND = 404;
    const HTTP_CODE_METHOD_NOT_ALLOWED = 405;
    const HTTP_CODE_NOT_ACCEPTABLE = 406;
    const HTTP_CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_CODE_REQUEST_TIMEOUT = 408;
    const HTTP_CODE_CONFLICT = 409;
    const HTTP_CODE_GONE = 410;
    const HTTP_CODE_LENGTH_REQUIRED = 411;
    const HTTP_CODE_PRECONDITION_FAILED = 412;
    const HTTP_CODE_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_CODE_REQUEST_URI_TOO_LONG = 414;
    const HTTP_CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_CODE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_CODE_EXPECTATION_FAILED = 417;
    const HTTP_CODE_I_M_A_TEAPOT = 418;
    const HTTP_CODE_ENHANCE_YOUR_CALM = 420;
    const HTTP_CODE_UNPROCESSABLE_ENTITY = 422;
    const HTTP_CODE_LOCKED = 423;
    const HTTP_CODE_FAILED_DEPENDENCY = 424;
    const HTTP_CODE_RESERVED_FOR_WEBDAV = 425;
    const HTTP_CODE_UPGRADE_REQUIRED = 426;
    const HTTP_CODE_PRECONDITION_REQUIRED = 428;
    const HTTP_CODE_TOO_MANY_REQUESTS = 429;
    const HTTP_CODE_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const HTTP_CODE_NO_RESPONSE = 444;
    const HTTP_CODE_RETRY_WITH = 449;
    const HTTP_CODE_BLOCKED_BY_WINDOWS_PARENTAL_CONTROLS = 450;
    const HTTP_CODE_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const HTTP_CODE_CLIENT_CLOSED_REQUEST = 499;
    const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;
    const HTTP_CODE_NOT_IMPLEMENTED = 501;
    const HTTP_CODE_BAD_GATEWAY = 502;
    const HTTP_CODE_SERVICE_UNAVAILABLE = 503;
    const HTTP_CODE_GATEWAY_TIMEOUT = 504;
    const HTTP_CODE_HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_CODE_VARIANT_ALSO_NEGOTIATES = 506;
    const HTTP_CODE_INSUFFICIENT_STORAGE = 507;
    const HTTP_CODE_LOOP_DETECTED = 508;
    const HTTP_CODE_BANDWIDTH_LIMIT_EXCEEDED = 509;
    const HTTP_CODE_NOT_EXTENDED = 510;
    const HTTP_CODE_NETWORK_AUTHENTICATION_REQUIRED = 511;
    const HTTP_CODE_NETWORK_READ_TIMEOUT_ERROR = 598;
    const HTTP_CODE_NETWORK_CONNECT_TIMEOUT_ERROR = 599;
}
