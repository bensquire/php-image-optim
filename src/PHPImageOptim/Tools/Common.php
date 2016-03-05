<?php

namespace PHPImageOptim\Tools;

use Exception;

class Common
{
    protected $binaryPath = '';
    protected $imagePath = '';
    protected $outputPath = '';
    protected $originalFileSize = '';
    protected $finalFileSize = '';
    protected $optimisationLevel = 1;

    /**
     * Sets the path of the executable
     *
     * @param string $binaryPath
     *
     * @return $this
     * @throws Exception
     */
    public function setBinaryPath($binaryPath = '')
    {
        if (!file_exists($binaryPath)) {
            throw new Exception('Unable to locate binary file');
        }

        $this->binaryPath = $binaryPath;
        return $this;
    }

    /**
     * Sets the path of the image
     *
     * @param $imagePath
     *
     * @return $this
     * @throws Exception
     */
    public function setImagePath($imagePath)
    {
        if (!file_exists($imagePath)) {
            throw new Exception('Invald image path');
        }

        if (!is_readable($imagePath)) {
            throw new Exception('The file cannot be read');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * Sets the desired level of optimisation.
     *
     * @param int $level
     *
     * @return $this
     * @throws \Exception
     */
    public function setOptimisationLevel($level = 2)
    {
        if (!is_int($level)) {
            throw new Exception('Invalid Optimisation Level');
        }

        if ($level !== ToolsInterface::OPTIMISATION_LEVEL_BASIC &&
            $level !== ToolsInterface::OPTIMISATION_LEVEL_STANDARD &&
            $level !== ToolsInterface::OPTIMISATION_LEVEL_EXTREME
        ) {
            throw new Exception('Invalid Optimisation level');
        }

        $this->optimisationLevel = $level;
        return $this;
    }

    /**
     * Calculates and stores the pre-optimised fileSize
     *
     * @return $this
     */
    public function determinePreOptimisedFileSize()
    {
        $this->originalFileSize = filesize($this->imagePath);
        return $this;
    }

    /**
     * Calculates and stores the post-optimised fileSize
     *
     * @return $this
     */
    public function determinePostOptimisedFileSize()
    {
        $this->finalFileSize = filesize($this->imagePath);
        return $this;
    }
}
