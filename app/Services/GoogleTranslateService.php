<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;
use Exception;

class GoogleTranslateService
{
    protected $translate;

    public function __construct()
    {
        $this->translate = new TranslateClient([
            'keyFilePath' => env('GOOGLE_CLOUD_KEY_FILE_PATH')
        ]);
    }

    public function translateText($text, $targetLanguage)
    {
        try {
            $result = $this->translate->translate($text, [
                'target' => $targetLanguage
            ]);
            return $result['text'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
