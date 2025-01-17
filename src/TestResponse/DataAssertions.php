<?php declare(strict_types=1);

namespace Soyhuce\Testing\TestResponse;

use Closure;

/**
 * @mixin \Illuminate\Testing\TestResponse<\Symfony\Component\HttpFoundation\Response>
 */
class DataAssertions
{
    public function assertData(): Closure
    {
        return function ($expect): self {
            $this->assertJsonPath('data', $expect);

            return $this;
        };
    }

    public function assertDataPath(): Closure
    {
        return function (string $key, $expect): self {
            $this->assertJsonPath("data.{$key}", $expect);

            return $this;
        };
    }

    public function assertDataPathCanonicalizing(): Closure
    {
        return function (string $key, array $expect): self {
            $this->assertJsonPathCanonicalizing("data.{$key}", $expect);

            return $this;
        };
    }

    public function assertDataPaths(): Closure
    {
        /**
         * @param array<string, mixed> $expectations
         */
        return function (array $expectations): self {
            foreach ($expectations as $key => $expect) {
                $this->assertDataPath($key, $expect);
            }

            return $this;
        };
    }

    public function assertDataPathsCanonicalizing(): Closure
    {
        /**
         * @param array<string, array<string, mixed>> $expectations
         */
        return function (array $expectations): self {
            foreach ($expectations as $key => $expect) {
                $this->assertDataPathCanonicalizing($key, $expect);
            }

            return $this;
        };
    }

    public function assertDataMissing(): Closure
    {
        return function ($item): self {
            $this->assertJsonPathMissing('data', $item);

            return $this;
        };
    }

    public function assertDataPathMissing(): Closure
    {
        return function (string $path, $item): self {
            $this->assertJsonPathMissing("data.{$path}", $item);

            return $this;
        };
    }
}
