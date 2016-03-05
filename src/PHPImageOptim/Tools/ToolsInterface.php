<?php
namespace PHPImageOptim\Tools;

interface ToolsInterface
{
    const OPTIMISATION_LEVEL_BASIC = 1;
    const OPTIMISATION_LEVEL_STANDARD = 2;
    const OPTIMISATION_LEVEL_EXTREME = 3;

    function optimise();

    function setBinaryPath($binaryPath);

    function checkVersion();

    function setImagePath($imagePath);

    function determinePreOptimisedFileSize();

    function determinePostOptimisedFileSize();

    function setOptimisationLevel($level = 2);
}
