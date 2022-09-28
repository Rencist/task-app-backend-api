<?php

namespace App\Infrastrucutre\Service;

use App\Core\Domain\Models\MabaAccount;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;
use Firebase\JWT\ExpiredException;
use App\Core\Domain\Models\User\User;
use App\Core\Domain\Models\User\UserId;
use Firebase\JWT\SignatureInvalidException;
use App\Core\Domain\Service\JwtManagerInterface;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Exceptions\MabacupException;

class JwtManager implements JwtManagerInterface
{
    public UserRepositoryInterface $user_repository;

    /**
     * @param UserRepositoryInterface $user_repository
     * @param NlcMemberRepositoryInterface $nlc_member_repository
     * @param NpcMemberRepositoryInterface $npc_member_repository
     * @param NstOrderRepositoryInterface $nst_order_repository
     */
    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }


    public function createFromUser(User $user): string
    {
        return JWT::encode(
            [
                'user_id' => $user->getId()->toString()
            ],
            config('app.key'),
            'HS256'
        );
    }

    /**
     * @throws Exception
     */
    public function decode(string $jwt): MabaAccount
    {
        try {
            $jwt = JWT::decode(
                $jwt,
                new Key(config('app.key'), 'HS256')
            );
        } catch (ExpiredException $e) {
            MabacupException::throw('JWT has expired', 902);
        } catch (SignatureInvalidException $e) {
            MabacupException::throw('JWT signature is invalid', 903);
        } catch (UnexpectedValueException $e) {
            MabacupException::throw('Unexpected JWT format', 907);
        }
        $user = $this->user_repository->find(new UserId($jwt->user_id));
        if (!$user) {
            MabacupException::throw("User not found!", 1500);
        }
        return new MabaAccount(
            new UserId($jwt->user_id)
        );
    }
}