<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class Guetzli extends Common implements ToolsInterface
{
    /**
     * @var string
     */
    private $attributes;

    /**
     * Guetzli constructor.
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = ['quality' => 85])
    {
        $arguments = [];

        foreach ($options as $key => $value) {
            $arguments[] = sprintf('--%s %s', $key, $value);
        }

        $this->attributes = join(' ', $arguments);
    }

    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        exec(
            sprintf(
                $this->binaryPath . ' %s %s %s',
                $this->attributes,
                escapeshellarg($this->imagePath),
                escapeshellarg($this->imagePath)
            ),
            $output,
            $optimResult
        );

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('GUETZLI was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }
        return $this;
    }

    /**
     * @throws Exception
     * @return string
     */
    public function getVersion(): string
    {
        throw new Exception('Unable to determine version, CLI doesnt provide this.');
    }
}
