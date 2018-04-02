<?php

namespace PHPImageOptim;

use Exception;

class PHPImageOptim
{
    /**
     * @var string
     */
    protected $imagePath = '';

    /**
     * @var array 
     */
    protected $chainedCommands = array();

    /**
     * Sets the path of the image we want to minify
     *
     * @param string $imagePath
     *
     * @return $this
     * @throws Exception
     */
    public function setImage($imagePath = '')
    {
        if (!file_exists($imagePath)) {
            throw new Exception('Image doesn\'t exist.');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * Adds a command to perform optimisation against
     *
     * @param $object
     *
     * @return $this
     */
    public function chainCommand($object)
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
