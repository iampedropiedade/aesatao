<?php
namespace Application\Controller\Api;

use Concrete\Core\Validation\CSRF\Token;
use Symfony\Component\HttpFoundation\JsonResponse;
use Concrete\Core\User\User;
use Concrete\Core\Support\Facade\Url;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractApiController
{
    public function authStatus(): JsonResponse
    {
        $user = new User();

        if($user->getUserID() === null) {
            return new JsonResponse([]);
        }

        return new JsonResponse([
            'userId' => $user->getUserID(),
            'userName' => $user->getUserName(),
            'firstname' => $user->getUserInfoObject()->getAttribute('firstname'),
            'lastname' => $user->getUserInfoObject()->getAttribute('lastname'),
            'logoutUrl' => (string)Url::to('/login', 'do_logout', (new Token())->generate('do_logout')),
        ]);

    }
}
