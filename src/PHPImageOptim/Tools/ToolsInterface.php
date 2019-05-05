<?php
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

    public function checkVersion();

    /**
     * @param string $imagePath
     * @return mixed
     */
    public function setImagePath(string $imagePath);

    public function determinePreOptimisedFileSize();

    public function determinePostOptimisedFileSize();

    /**
     * @param int $level
     * @return mixed
     */
    public function setOptimisationLevel(int $level = 2);
}
