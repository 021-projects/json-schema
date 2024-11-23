<?php

namespace O21\JsonSchema\Enums;

enum Format: string
{
    case DATE = 'date';
    case TIME = 'time';
    case DATE_TIME = 'date-time';
    case EMAIL = 'email';
    case IDN_EMAIL = 'idn-email';
    case HOSTNAME = 'hostname';
    case IDN_HOSTNAME = 'idn-hostname';
    case IPV4 = 'ipv4';
    case IPV6 = 'ipv6';
    case UUID = 'uuid';
    case URI = 'uri';
    case URI_REFERENCE = 'uri-reference';
    case URI_TEMPLATE = 'uri-template';
    case IRI = 'iri';
    case IRI_REFERENCE = 'iri-reference';
    case JSON_POINTER = 'json-pointer';
    case RELATIVE_JSON_POINTER = 'relative-json-pointer';
    case REGEX = 'regex';
}
