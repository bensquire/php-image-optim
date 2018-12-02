<?php

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class MozJpeg extends Common implements ToolsInterface
{
    private $attributes = '';

    /**
     * MozJpeg constructor.
     * @param array $options
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
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPImageOptim');
        $command = sprintf(
            $this->binaryPath . ' %s -outfile %s %s',
            $this->attributes,
            escapeshellarg($tempFile),
            escapeshellarg($this->imagePath)
        );

        exec(
            $command,
            $aOutput,
            $iResult
        );

        rename($tempFile, $this->imagePath);

        if ($this->stopIfFail && $iResult !== 0) {
            throw new Exception('MOZJPEG was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }
        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
