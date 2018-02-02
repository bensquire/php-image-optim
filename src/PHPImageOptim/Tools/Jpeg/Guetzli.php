<?php

namespace PHPImageOptim\Tools\Jpeg;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class Guetzli extends Common implements ToolsInterface
{
    private $attributes = '';

    public function __construct($options = ['quality' => 85])
    {
        $arguments = [];

        foreach ($options as $key => $value) {
            $arguments[] = sprintf('--%s %s', $key, $value);
        }

        $this->attributes = join(' ', $arguments);
    }

    public function optimise()
    {
        exec(
            sprintf(
                $this->binaryPath . ' %s %s %s',
                $this->attributes,
                escapeshellarg($this->imagePath),
                escapeshellarg($this->imagePath)
            ),
            $aOutput,
            $iResult
        );

        if ($iResult !== 0) {
            throw new Exception('MozJpeg was unable to optimise image.');
        }
        return $this;
    }

    public function checkVersion()
    {
        exec($this->binaryPath . ' --version', $aOutput, $iResult);
    }
}
