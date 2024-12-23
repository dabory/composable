<?php

namespace App\Interfaces;

interface NotificationServiceInterface
{
    public function sendNotification($apiName, array $template);
    public function createTemplate(array $templateData): array;
    public function requestTemplate(array $templateData): array;
    public function listTemplate(): array;
    public function sendTemplate($brandCode, $receiver, $replacementValues, $variableNames);
}
