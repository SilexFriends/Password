<?php
declare(strict_types = 1);

namespace SilexFriends\Password;

/**
 * Password Service Provider Interface
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
interface PasswordInterface
{
    /**
     * @const string
     */
    const GENERATE = 'password.generate';

    /**
     * @const string
     */
    const VERIFY   = 'password.verify';

    /**
     * @param string $password
     * @param int $cost
     * @return string
     */
    public function generate (string $password, int $cost): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify (string $password, string $hash): bool;
}
