<?php


namespace App\Carnovo\Security\Application;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class BasicAuthenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return $request->headers->has('Authorization')
            && 0 === strpos( $request->headers->get('Authorization'), 'Basic ');
    }

    public function getCredentials(Request $request): array
    {
        $auth = $request->headers->get('Authorization');
        $auth_array = explode("Basic ", $auth);
        $userAndPassword = explode(":", base64_decode($auth_array[1]));
        $user = $userAndPassword[0];
        $password = $userAndPassword[1];
        return array(
            'user' => $user,
            'password' => $password,
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        $user = $credentials['user'] ?? null;
        $password = $credentials['password'] ?? null;

        if (null === $user || null === $password) {
            return null;
        }

        return $userProvider->loadUserByUsername($user);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $user->getUsername() === $credentials["user"]
            && $user->getPassword() === $credentials["password"];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}