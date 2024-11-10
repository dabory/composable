<?php

namespace App\Helpers;

use App\Exceptions\ParameterException;
use App\Services\CallApiService;
use App\Services\MediaLibraryService;
use Exception;
use Illuminate\Filesystem\Filesystem;

class File
{
    public static function codeTitleFor($type, $name, $value)
    {
        return self::getCodeTitleFiles($type)[$name][$value]['Title'];
    }

    public static function mimeType($path)
    {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
    }

    public static function uploadImg($file)
    {
        $mediaLibraryService = app(MediaLibraryService::class);
        $mediaLibraryService->setGateToken(session('GateToken')['main']);
        $setup = $mediaLibraryService->getSetup('post');
        $path = $mediaLibraryService->getCurrSetupFilePath($setup);
        $path = preg_replace('/\/$/', '', $path);
        $filePath = \Storage::disk(getDisk())->put($path, $file);

        return '/' . $filePath;
    }

    public static function changeEnvironmentVariable($key, $value, $isArr = false, $fileName = '.env')
    {
        $path = base_path($fileName);

        if (is_bool(env($key)))
        {
            $old = env($key) ? 'true' : 'false';
        }
        else if (env($key) === null){
            $old = 'null';
        }
        else {
            $old = env($key);
        }

        if (file_exists($path)) {
            if ($isArr) {
                $old = "'$old'";
                $value = "'$value'";
            }

            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=".$value, file_get_contents($path)
            ));
        }
    }

    public static function getSkinDirectories()
    {
        return array_map('basename', \Storage::disk('erp')->directories('/themes/pro'));
    }

    public static function getThemeCodeTitleDirectories($themeDir)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "themes/{$themeDir}/para/{$countryCode}/etc/code-title";
        if (file_exists(daboryPath($setPath))) {
            $paramsFilePath = array_map('basename', \Storage::disk('erp')->directories($setPath));
        } else {
            throw new ParameterException('CodeTitle Directories Not Found (Theme) : ' . daboryPath($setPath));
        }

        return $paramsFilePath;
    }

    public static function getThemeCodeTitleFiles($funcName, $themeDir)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "themes/{$themeDir}/para/{$countryCode}/etc/code-title/${funcName}";

        if (\Storage::disk('erp')->exists($setPath)) {
            $files = \Storage::disk('erp')->allFiles($setPath);
            foreach ($files as $key => $file) {
                $data[basename($file, '.json')] = collect(json_decode(\Storage::disk('erp')->get($file), true))->keyBy('Code')->toArray();
            }
        }

        return $data;
    }


    public static function getCodeTitleDirectories()
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "para/erp/{$countryCode}/etc/code-title";
        if (file_exists(daboryPath($setPath))) {
            $paramsFilePath = array_map('basename', \Storage::disk('dabory')->directories($setPath));
        } else {
            throw new ParameterException('CodeTitle Directories Not Found (Main) : ' . daboryPath($setPath));
        }

        return $paramsFilePath;
    }

    public static function getCodeTitleFiles($funcName)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];
        $setPath = "para/erp/{$countryCode}/etc/code-title/${funcName}";

        if (\Storage::disk('dabory')->exists($setPath)) {
            $files = \Storage::disk('dabory')->allFiles($setPath);
            foreach ($files as $key => $file) {
                $data[basename($file, '.json')] = collect(json_decode(\Storage::disk('dabory')->get($file), true))->keyBy('Code')->toArray();
            }
        }

        return $data;
    }

    // 라라벨에서 파일업로드할 때 php.ini에 정해져있는 임시폴더에 저장하는 방법 비슷하게 구현
    public static function createFromUrl(string $url, string $originalName = '', string $mimeType = null, int $error = null, bool $test = false)
    {
        // url을 이용해서 파일 Read.
        if (! $stream = @fopen($url, 'r')) {
            throw new Exception($url);
        }

        // 임시폴더명/저장파일명 얻는다
        $tempFile = tempnam(sys_get_temp_dir(), 'php');
        // 파일의 originalName을 구한다.
        $originalName = explode(sys_get_temp_dir() . '/', $tempFile)[1];
        // 파일을 임시폴더에 쓴다.
        file_put_contents($tempFile, $stream);

        // 프론트에서 업로드 할 때와 같은 파일 Type으로 반환
        return new \Illuminate\Http\UploadedFile($tempFile, $originalName, $mimeType, $error, $test);
    }

    public static function pathToUploadedFile($path, $test = true): \Illuminate\Http\File
    {
//        $filesystem = new Filesystem;
//        $name = $filesystem->name( $path );
//        $extension = $filesystem->extension( $path );
//        $originalName = $name . '.' . $extension;
//        $mimeType = $filesystem->mimeType( $path );
//        $error = null;

        return new \Illuminate\Http\File( $path );
    }

    public static function forceFilePutContents (string $fullPathWithFileName, string $fileContents)
    {
        $exploded = explode(DIRECTORY_SEPARATOR,$fullPathWithFileName);

        array_pop($exploded);

        $directoryPathOnly = implode(DIRECTORY_SEPARATOR, $exploded);

        if (!\Illuminate\Support\Facades\File::exists($directoryPathOnly))
        {
            \Illuminate\Support\Facades\File::makeDirectory($directoryPathOnly,0775,true,false);
        }
        return \Illuminate\Support\Facades\File::put($fullPathWithFileName,$fileContents);
    }
}
