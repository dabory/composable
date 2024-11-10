<?php

namespace App\Helpers;

class ResponseConverter
{
    public static function joinFor($hdPage, $bdPage, $toName = 'HId', $fromName = 'Id', $pageName = 'BdPage'): array
    {
        return collect($hdPage)->map(function ($hd) use ($bdPage, $toName, $fromName, $pageName) {
            $filterPage = collect($bdPage)->filter(function ($bd) use ($hd, $toName, $fromName) {
                return $hd[$fromName] === (int)$bd[$toName];
            })->values()->toArray();

            return array_merge($hd, [$pageName => $filterPage]);
        })->toArray();
    }
}
