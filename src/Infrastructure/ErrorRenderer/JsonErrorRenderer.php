<?php
namespace App\Infrastructure\ErrorRenderer;

use Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class JsonErrorRenderer implements ErrorRendererInterface
{
    private $debug;

    /**
     * {@inheritdoc}
     */
    public static function getFormat(): string
    {
        return 'json';
    }

    public function __construct(bool $debug = true)
    {
        $this->debug = $debug;
    }

    /**
     * {@inheritdoc}
     */
    public function render(FlattenException|\Throwable $exception): FlattenException
    {
        $content = [
            '@id' => 'https://example.com',
            '@type' => 'error',
            '@context' => [
                'code' => $exception->getStatusCode(),
                'message' => $exception->getMessage(),
            ],
        ];
        if ($this->debug) {
            $content['@context']['exceptions'] = $exception->toArray();
        }

        return json_encode($content);
    }
}