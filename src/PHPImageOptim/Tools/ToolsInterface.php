<?php
namespace PHPImageOptim\Tools;

interface ToolsInterface
{
    public const OPTIMISATION_LEVEL_BASIC = 1;
    public const OPTIMISATION_LEVEL_STANDARD = 2;
    public const OPTIMISATION_LEVEL_EXTREME = 3;

    public function optimise(): ToolsInterface;

    public function setBinaryPath($binaryPath);

    public function checkVersion();

    public function setImagePath($imagePath);

    public function determinePreOptimisedFileSize();

    public function determinePostOptimisedFileSize();

    public function setOptimisationLevel($level = 2);
}
