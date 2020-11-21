<?php


namespace App\Carnovo\Security\Infrastructure\Persistence\Repository;


use App\Carnovo\Security\Domain\Interfaces\CredentialsRepository;
use App\Carnovo\Security\Domain\Model\ApiCredentials;

class DiskCredentialsRepository implements CredentialsRepository
{
    private ApiCredentials $user;

    public function __construct(string $user, string $password)
    {
        $this->user = new ApiCredentials($user, $password);
    }

    public function get(): ApiCredentials
    {
        return $this->user;
    }
}