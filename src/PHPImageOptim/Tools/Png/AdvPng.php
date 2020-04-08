<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class AdvPng extends Common implements ToolsInterface
{
    private const FORMAT = 'png';

    /**
     * @return string
     */
    public function getCompatibleImageFormat(): string
    {
        return self::FORMAT;
    }

    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' -z -4 -i20 -- ' . escapeshellarg($this->imagePath),
            $output,
            $result
        );

        if (true === $this->stopOnFailure && 0 !== $result) {
            throw new Exception('ADVPNG was unable to optimise image, result:' . $result . ' File: ' . $this->imagePath);
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
        exec($this->binaryPath . ' --version', $output, $result);

        if (0 !== $result) {
            throw new Exception('Unable to determine version, error code: ' . $result);
        }

        $versionMatches = [];
        preg_match('/advancecomp v([0-9]+.[0-9]+)/m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
