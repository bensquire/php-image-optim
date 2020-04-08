<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class OptiPng extends Common implements ToolsInterface
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
            $this->binaryPath . ' -i0 -o7 -zm1-9 ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('OPTIPNG was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
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
        preg_match('/OptiPNG version ([0-9]+.[0-9]+.[0-9]+)/m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
