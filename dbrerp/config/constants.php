<?php

$localeSequence =  preg_replace('/\s+/', '', explode(',', env('LOCALE_SEQUENCE')));

return [
    'countries' => $localeSequence
];
