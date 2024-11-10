<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AppleTokenService
{
    public function generate($privateKey, $clientId, $teamId, $keyId): string
    {
        $jwtConfig = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey)
        );

        $now = CarbonImmutable::now();

        $token = $jwtConfig->builder()
            ->issuedBy($teamId)
            ->issuedAt($now)
            ->expiresAt($now->addHour())
            ->permittedFor('https://appleid.apple.com')
            ->relatedTo($clientId)
            ->withHeader('kid', $keyId)
            ->getToken($jwtConfig->signer(), $jwtConfig->signingKey());

        return $token->toString();
    }
}
