<?php declare(strict_types=1);
namespace PHPImageOptim\Tools;

interface ToolsInterface
{
    public const OPTIMISATION_LEVEL_BASIC = 1;
    public const OPTIMISATION_LEVEL_STANDARD = 2;
    public const OPTIMISATION_LEVEL_EXTREME = 3;

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
     * TODO: Remove this?
     * @return mixed
     */
    public function determinePreOptimisedFileSize();

    /**
     * TODO: Remove this?
     * @return mixed
     */
    public function determinePostOptimisedFileSize();

    /**
     * @param int $level
     * @return mixed
     */
    public function setOptimisationLevel(int $level = 2);
}
