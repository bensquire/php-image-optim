<?php

namespace PHPImageOptim\Tools;

use Exception;

class Common
{
    /**
     * @var string
     */
    protected $binaryPath = '';

    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var string
     */
    protected $outputPath = '';

    /**
     * @var int
     */
    protected $originalFileSize = 0;

    /**
     * @var int
     */
    protected $finalFileSize = 0;

    /**
     * @var int
     */
    protected $optimisationLevel = 1;

    /**
     * @var bool
     */
    protected $stopIfFail = true;

    /**
     * @param string $binaryPath
     * @return $this
     * @throws Exception
     */
    public function setBinaryPath(string $binaryPath = ''): Common
    {
        if (!file_exists($binaryPath)) {
            throw new Exception('Unable to locate binary file');
        }

        $this->binaryPath = $binaryPath;
        return $this;
    }

    /**
     * @param bool $stopIfFail
     * @return $this
     */
    public function setStopIfFail(bool $stopIfFail): Common
    {
        $this->stopIfFail = $stopIfFail;
        return $this;
    }

    /**
     * @param string $imagePath
     * @return Common
     * @throws Exception
     */
    public function setImagePath(string $imagePath): Common
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
     * @param int $level
     * @return $this
     * @throws Exception
     */
    public function setOptimisationLevel(int $level = 2): Common
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
     * @return Common
     * @throws Exception
     */
    public function determinePreOptimisedFileSize(): Common
    {
        $fileSize = filesize($this->imagePath);

        if ($fileSize === false) {
            throw new \Exception('Unable to determine pre-optimised fileSize');
        }

        $this->originalFileSize = $fileSize;
        return $this;
    }

    /**
     * @return Common
     * @throws Exception
     */
    public function determinePostOptimisedFileSize(): Common
    {
        $fileSize = filesize($this->imagePath);

        if ($fileSize === false) {
            throw new \Exception('Unable to determine post-optimised fileSize');
        }

        $this->finalFileSize = $fileSize;
        return $this;
    }
}
