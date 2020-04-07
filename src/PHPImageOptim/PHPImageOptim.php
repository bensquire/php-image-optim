<?php declare(strict_types=1);

namespace PHPImageOptim;

use Exception;
use PHPImageOptim\Tools\ToolsInterface;

class PHPImageOptim
{
    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var ToolsInterface[]
     */
    protected $chainedCommands = [];

    /**
     * @param string $imagePath
     * @throws Exception
     * @return PHPImageOptim
     */
    public function setImage(string $imagePath = ''): PHPImageOptim
    {
        if (false === file_exists($imagePath)) {
            throw new Exception('Image doesn\'t exist.');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param mixed $object
     * @param bool $stopIfFail
     * @return PHPImageOptim
     */
    public function chainCommand($object, bool $stopIfFail = true): PHPImageOptim
    {
        $object->setStopOnFailure($stopIfFail);
        $this->chainedCommands[] = $object;
        return $this;
    }

    /**
     * @return bool
     */
    public function optimise(): bool
    {
        foreach ($this->chainedCommands as $chainedCommand) {
            $chainedCommand->setImagePath($this->imagePath);
            $chainedCommand->determinePreOptimisedFileSize();
            $chainedCommand->optimise();
            $chainedCommand->determinePostOptimisedFileSize();
        }

        return true;
    }

    /**
     * @return array
     */
    public function getVersions(): array
    {
        $versions = [];
        foreach ($this->chainedCommands as $chainedCommand) {
            $versions[get_class($chainedCommand)] = $chainedCommand->getVersion();
        }

        return $versions;
    }
}
