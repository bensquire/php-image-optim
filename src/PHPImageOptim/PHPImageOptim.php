<?php

namespace PHPImageOptim;

use \Exception;
use PHPImageOptim\Tools\ToolsInterface;

class PHPImageOptim
{
    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var array
     */
    protected $chainedCommands = [];

    /**
     * @param string $imagePath
     * @return $this
     * @throws Exception
     */
    public function setImage(string $imagePath = '')
    {
        if (!file_exists($imagePath)) {
            throw new Exception('Image doesn\'t exist.');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @param ToolsInterface $object
     * @return $this
     */
    public function chainCommand(ToolsInterface $object)
    {
        $this->chainedCommands[] = $object;
        return $this;
    }

    /**
     * Starts the optimisation process
     *
     * @return bool
     */
    public function optimise()
    {
        foreach ($this->chainedCommands as $chainedCommand) {
            $chainedCommand->determinePreOptimisedFileSize();
            $chainedCommand->setImagePath($this->imagePath);
            $chainedCommand->optimise();
            $chainedCommand->determinePostOptimisedFileSize();
        }

        return true;
    }
}
