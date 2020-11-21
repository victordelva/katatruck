<?php


namespace App\Carnovo\Security\Application;

use App\Carnovo\Security\Domain\Interfaces\CredentialsRepository;
use App\Carnovo\Security\Domain\Model\ApiCredentials;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiCredentialsProvider implements UserProviderInterface
{
    private CredentialsRepository $credentialsRepository;

    public function __construct(CredentialsRepository $credentialsRepository)
    {
        $this->credentialsRepository = $credentialsRepository;
    }

    public function loadUserByUsername($username)
    {
        return $this->fetchUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return ApiCredentials::class === $class;
    }

    private function fetchUser($username)
    {
        $user = $this->credentialsRepository->get();
        if ($user->getUsername() === $username) {
            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Api credentials "%s" does not exist.', $username)
        );
    }
}