<?php


namespace App\Carnovo\Security\Domain\Model;


use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiCredentials implements UserInterface, EquatableInterface
{
    private ?string $user;
    private ?string $password;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->user;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return [];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function eraseCredentials()
    {
        //
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof ApiCredentials) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        if ($this->getPassword() !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        return true;
    }

}