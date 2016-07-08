<?php
declare(strict_types = 1);

namespace SilexFriends\Password;

use Silex\Application;
use Silex\ServiceProviderInterface;
/**
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 * @author Marcel Araujo <admin@marcelaraujo.me>
 */
class Password implements PasswordInterface, ServiceProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * Password constructor.
     *
     * @param int $cost
     */
    public function __construct(int $cost)
    {
        $this->config = ['cost' => $cost];
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::register()
     * @param Application $app
     */
    public function register(Application $app)
    {
        $service = $this;

        $app[static::GENERATE] = $app->protect(
            function (string $password) use ($service) {
                return $service->generate($password, $this->config['cost']);
            }
        );

        $app[static::VERIFY] = $app->protect(
            function (string $password, string $hash) use ($service) {
                return $service->verify($password, $hash);
            }
        );
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::boot()
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // :)
    }

    /**
     * @inheritdoc
     */
    public function generate(string $password, int $cost): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
    }

    /**
     * @inheritdoc
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
