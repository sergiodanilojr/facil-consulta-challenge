<?php

namespace App\Services;

use App\Exceptions\AuthException;
use Illuminate\Contracts\Auth\Authenticatable;
use DateTime;

class AuthService
{
    protected static string $guard = 'api';
    protected ?string $token;

    public function __construct(
        private ?string $email = null,
        private ?string $password = null,
    )
    {
        $this->validate();
    }

    public static function withCredentials(string $email, string $password)
    {
        return new self(email: $email, password: $password);
    }

    public function isValid(): bool
    {
        return auth(self::$guard)->validate($this->getCredentials());
    }

    public function login()
    {
        throw_if(
            !($this->token = auth(self::$guard)->attempt($this->getCredentials())),
            AuthException::class);

        return $this;
    }

    public function token(): string
    {
        return $this->token;
    }

    public static function refresh()
    {
        return auth(self::$guard)->refresh(true, true);
    }

    public static function user(): Authenticatable
    {
        return auth(self::$guard)->user();
    }

    public static function logout(): void
    {
        auth()->logout();
    }

    public function tokenType(): string
    {
        return 'bearer';
    }

    public function expiresIn(): int
    {
        return ((int)config('jwt.ttl', 60)) * 60;
    }

    public function expiresAt(): \DateTimeInterface
    {
        return new DateTime("+{$this->expiresIn()}SECONDS");
    }

    public function toArray()
    {
        return [
            'access_token' => $this->token(),
            'token_type' => $this->tokenType(),
            'expires_in' => $this->expiresIn(),
        ];
    }

    protected function validate(): void
    {
        throw_if(empty(self::$guard), AuthException::class);

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthException('Whooops... Invalid Credentials!');
        }
    }

    protected function getCredentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
