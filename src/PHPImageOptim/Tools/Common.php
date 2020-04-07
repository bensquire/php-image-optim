<?php declare(strict_types=1);

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
    protected $stopOnFailure = true;

    /**
     * @param string $binaryPath
     * @throws Exception
     * @return $this
     */
    public function setBinaryPath(string $binaryPath = ''): Common
    {
        if (false === file_exists($binaryPath)) {
            throw new Exception('Unable to locate binary file');
        }

        $this->binaryPath = $binaryPath;
        return $this;
    }

    /**
     * @param bool $stopOnFailure
     * @return $this
     */
    public function setStopOnFailure(bool $stopOnFailure): Common
    {
        $this->stopOnFailure = $stopOnFailure;
        return $this;
    }

    /**
     * @param string $imagePath
     * @throws Exception
     * @return Common
     */
    public function setImagePath(string $imagePath): Common
    {
        if (false === file_exists($imagePath)) {
            throw new Exception('Invald image path');
        }

        if (false === is_readable($imagePath)) {
            throw new Exception('The file cannot be read');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param int $level
     * @throws Exception
     * @return $this
     */
    public function setOptimisationLevel(int $level = 2): Common
    {
        if (ToolsInterface::OPTIMISATION_LEVEL_BASIC !== $level &&
            ToolsInterface::OPTIMISATION_LEVEL_STANDARD !== $level &&
            ToolsInterface::OPTIMISATION_LEVEL_EXTREME !== $level
        ) {
            throw new Exception('Invalid Optimisation level');
        }

        $this->optimisationLevel = $level;
        return $this;
    }

    /**
     * @throws Exception
     * @return Common
     */
    public function determinePreOptimisedFileSize(): Common
    {
        $fileSize = filesize($this->imagePath);

        if (false === $fileSize) {
            throw new Exception('Unable to determine pre-optimised fileSize');
        }

        $this->originalFileSize = $fileSize;
        return $this;
    }

    /**
     * @throws Exception
     * @return Common
     */
    public function determinePostOptimisedFileSize(): Common
    {
        $fileSize = filesize($this->imagePath);

        if (false === $fileSize) {
            throw new Exception('Unable to determine post-optimised fileSize');
        }

        $this->finalFileSize = $fileSize;
        return $this;
    }
}
