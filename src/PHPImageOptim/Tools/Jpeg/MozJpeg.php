<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class MozJpeg extends Common implements ToolsInterface
{
    /**
     * @var string
     */
    private $attributes;

    /**
     * MozJpeg constructor.
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = ['quality' => 85])
    {
        $arguments = [];

        foreach ($options as $key => $value) {
            $arguments[] = sprintf('-%s %s', $key, $value);
        }

        $this->attributes = join(' ', $arguments);
    }

    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPImageOptim');

        if (false === $tempFile) {
            throw new Exception('Unable to create temp file for PHPImageOptim');
        }

        $command = sprintf(
            $this->binaryPath . ' %s -outfile %s %s',
            $this->attributes,
            escapeshellarg($tempFile),
            escapeshellarg($this->imagePath)
        );

        exec($command, $output, $result);

        rename($tempFile, $this->imagePath);

        if (true === $this->stopOnFailure && 0 !== $result) {
            throw new Exception('MOZJPEG was unable to optimise image, result:' . $result . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    /**
     * @throws Exception
     * @return string
     */
    public function getVersion(): string
    {
        $output = [];
        exec($this->binaryPath . ' -v -q 2>&1', $output, $result);

        if (false === in_array($result, [0, 1], true)) {
            throw new Exception('Unable to determine version, error code: ' . $result);
        }

        $versionMatches = [];
        preg_match('/version ([0-9\.]{1,}[\w]) /m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
