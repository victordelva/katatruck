<?php


namespace App\Carnovo\Security\Domain\Interfaces;


use App\Carnovo\Security\Domain\Model\ApiCredentials;

interface CredentialsRepository
{
    public function get(): ApiCredentials;
}