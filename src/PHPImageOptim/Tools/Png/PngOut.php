<?php declare(strict_types=1);

namespace PHPImageOptim\Tools\Png;

use Exception;
use PHPImageOptim\Tools\Common;
use PHPImageOptim\Tools\ToolsInterface;

class PngOut extends Common implements ToolsInterface
{
    public const OPTIMISATION_LEVEL_BASIC = 1;
    public const OPTIMISATION_LEVEL_STANDARD = 2;
    public const OPTIMISATION_LEVEL_EXTREME = 3;

    /**
     * @var int
     */
    protected $optimisationLevel = 1;

    /**
     * @throws Exception
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface
    {
        exec(
            $this->binaryPath . ' ' . $this->getOptimisationLevel() . ' -q -y ' . escapeshellarg($this->imagePath) . ' ' . escapeshellarg($this->imagePath),
            $output,
            $optimResult
        );

        if (2 === $optimResult) {
            return $this;
        }

        if (true === $this->stopOnFailure && 0 !== $optimResult) {
            throw new Exception('PNGOUT was unable to optimise image, result:' . $optimResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }

    /**
     * Returns the optimisation level
     *
     * @throws Exception
     * @return string
     */
    public function getOptimisationLevel()
    {
        switch ($this->optimisationLevel) {
            case 1:
                return '-s3';
            case 2:
                return '-s2';
            case 3:
                return '-s1';
            default:
                throw new Exception('Unable to calculate optimisation level');
        }
    }

    /**
     * @param int $level
     * @throws Exception
     * @return $this
     */
    public function setOptimisationLevel(int $level = 2): Common
    {
        if (self::OPTIMISATION_LEVEL_BASIC !== $level &&
            self::OPTIMISATION_LEVEL_STANDARD !== $level &&
            self::OPTIMISATION_LEVEL_EXTREME !== $level
        ) {
            throw new Exception('Invalid Optimisation level');
        }

        $this->optimisationLevel = $level;
        return $this;
    }

    /**
     * @throws Exception
     * @return string
     */
    public function getVersion(): string
    {
        $output = [];
        exec($this->binaryPath . ' 2>&1', $output, $result);

        if (false === in_array($result, [0, 1], true)) {
            throw new Exception('Unable to determine version, error code: ' . $result);
        }

        $versionMatches = [];
        preg_match('/([\w]{3,4} [0-9]{1,2} [0-9]{4})$/', $output[0], $versionMatches);

        return $versionMatches[1];
    }
}
