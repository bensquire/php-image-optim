<?php

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngOut extends Common implements ToolsInterface
{
    /**
     * @return ToolsInterface
     * @throws Exception
     */
    public function optimise(): ToolsInterface
    {
        exec($this->binaryPath . ' ' . $this->getOptimisationLevel() . ' -q -y ' . escapeshellarg($this->imagePath) . ' ' . escapeshellarg($this->imagePath), $aOutput, $iResult);

        if ($iResult === 2) {
            return $this;
        }

        if ($this->stopIfFail && $iResult !== 0) {
            throw new Exception('PNGOUT was unable to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    /**
     * Returns the optimisation level
     *
     * @return string
     * @throws \Exception
     */
    public function getOptimisationLevel()
    {
        switch ($this->optimisationLevel) {
            case 1:
                return '-s3';
                break;

            case 2:
                return '-s2';
                break;

            case 3:
                return '-s1';
                break;

            default:
                throw new Exception('Unable to calculate optimisation level');
        }
    }

    public function checkVersion()
    {
        exec($this->binaryPath, $aOutput, $iResult);
    }
}
