<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class CompanyVendorServiceProvider extends ServiceProvider{
    public function boot()
    {
        return;
        // .env에서 DBR_THEME 읽어오기
        $companyName = env('DBR_THEME');

        // 회사명이 있을 때만 composer.json 업데이트
        if ($companyName) {
            $this->updateComposerJsonForTheme($companyName);
        }
    }

    protected function updateComposerJsonForTheme($companyName)
    {
        $composerFilePath = base_path('composer.json');

        // composer.json 파일이 존재하지 않으면 중단
        if (!File::exists($composerFilePath)) {
            return;
        }

        // composer.json 파일 내용 읽기
        $composerJson = json_decode(File::get($composerFilePath), true);

        if (!isset($composerJson['extra'])) {
            $composerJson['extra'] = [];
        }

        $themeComposerPath = "dabory/themes/{$companyName}/composer.json";
        // merge-plugin 비어있을 때
        if (!isset($composerJson['extra']['merge-plugin'])) {
            $composerJson['extra']['merge-plugin'] = [
                'include' => [],
                'recurse' => true,
                'replace' => false,
                'merge-dev' => false,
            ];

            $composerJson['extra']['merge-plugin']['include'] = [$themeComposerPath];
        } else {
            if (count($composerJson['extra']['merge-plugin']['include']) > 0 && $composerJson['extra']['merge-plugin']['include'][0] !== $themeComposerPath) {
                $composerJson['extra']['merge-plugin']['include'] = [$themeComposerPath];
            } else {
                return;
            }
        }

        // composer.json 다시 쓰기
        File::put($composerFilePath, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    }
}
