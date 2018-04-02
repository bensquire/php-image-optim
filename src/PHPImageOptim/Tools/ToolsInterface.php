<?php
namespace PHPImageOptim\Tools;

interface ToolsInterface
{
    const OPTIMISATION_LEVEL_BASIC = 1;
    const OPTIMISATION_LEVEL_STANDARD = 2;
    const OPTIMISATION_LEVEL_EXTREME = 3;

    public function optimise();

    public function setBinaryPath($binaryPath);

    public function checkVersion();

    public function setImagePath($imagePath);

    public function determinePreOptimisedFileSize();

    public function determinePostOptimisedFileSize();

    public function setOptimisationLevel($level = 2);
}
