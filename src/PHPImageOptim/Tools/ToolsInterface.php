<?php declare(strict_types=1);
namespace PHPImageOptim\Tools;

interface ToolsInterface
{
    /**
     * @return ToolsInterface
     */
    public function optimise(): ToolsInterface;

    /**
     * @param string $binaryPath
     * @return mixed
     */
    public function setBinaryPath(string $binaryPath);

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @param string $imagePath
     * @return mixed
     */
    public function setImagePath(string $imagePath);

    /**
     * @param bool $stopOnFailure
     * @return self
     */
    public function setStopOnFailure(bool $stopOnFailure);

    /**
     * @return string
     */
    public function getCompatibleImageFormat(): string;
}
