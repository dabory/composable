<?php

namespace App\Http\Controllers;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GoogleOCRController extends Controller
{
    /**
     * open the view.
     *
     * @param
     * @return void
     */
    public function index()
    {
        return view('googleOcr');
    }

    /**
     * handle the image
     *
     * @param
     * @return void
     */
    public function submit(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            if (Str::lower($file->extension()) === 'pdf') {
                $baseName = $file->getBasename();
                $outputPath = "/ocr-images/$baseName";

                $this->convertPdfToImages($file, $outputPath);
                $text = $this->extractTextFromImages($outputPath);
            } else {
                $text = $this->detectText($file);
            }

            dd($text);
        }

    }

    private function detectText($file)
    {
        $imageAnnotatorClient = new ImageAnnotatorClient([
            'credentials' => storage_path('/app/client_secret.json')
        ]);
        $text = '';

        $image = file_get_contents($file);
        $response = $imageAnnotatorClient->textDetection($image);
        $annotations = $response->getTextAnnotations();

        if ($annotations) {
            $text .= $annotations[0]->getDescription() . "\n";
        }

        return $text;
    }

    private function convertPdfToImages($pdfPath, $outputPath) {
        $imagick = new \Imagick();
        $imagick->setResolution(300, 300);
        $imagick->readImage($pdfPath);

        if (! Storage::disk()->exists($outputPath)) {
            Storage::disk()->makeDirectory($outputPath);
        }

        for ($i = 0; $i < $imagick->getNumberImages(); $i++) {
            $imagick->setIteratorIndex($i);
            $imagick->setImageFormat('png');
            $imagick->writeImage(Storage::path($outputPath) . "/page_" . $i . ".png");
        }
    }

    private function extractTextFromImages($imagesPath) {
        $imageAnnotatorClient = new ImageAnnotatorClient([
            'credentials' => storage_path('/app/client_secret.json')
        ]);
        $text = '';

        $files = glob(Storage::path($imagesPath) . '/*.png');
        foreach ($files as $file) {
            $image = file_get_contents($file);
            $response = $imageAnnotatorClient->textDetection($image);
            $annotations = $response->getTextAnnotations();

            if ($annotations) {
                $text .= $annotations[0]->getDescription() . "\n";
            }
        }

        Storage::deleteDirectory($imagesPath);
        $imageAnnotatorClient->close();
        return $text;
    }

}
