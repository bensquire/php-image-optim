<?php declare(strict_types=1);

namespace PHPImageOptim\Tools;

use Exception;

abstract class Common
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
     * @var bool
     */
    protected $stopOnFailure = true;

    /**
     * @param string $binaryPath
     * @throws Exception
     * @return $this
     */
    public function setBinaryPath(string $binaryPath = ''): self
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
    public function setStopOnFailure(bool $stopOnFailure): self
    {
        $this->stopOnFailure = $stopOnFailure;
        return $this;
    }

    /**
     * @param string $imagePath
     * @throws Exception
     * @return Common
     */
    public function setImagePath(string $imagePath): self
    {
        if (false === file_exists($imagePath)) {
            throw new Exception('Invalid image path');
        }

        if (false === is_readable($imagePath)) {
            throw new Exception('The file cannot be read');
        }

        $this->imagePath = $imagePath;
        return $this;
    }
}
