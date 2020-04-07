<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class JpegTran extends Common implements ToolsInterface
{
    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' -optimize ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('JPEGTRAN was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
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
        preg_match('/version ([0-9]{1,2}[\w])/m', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
