<?php

interface igs_CssParser
{
    /**
     * @param  string $cssString
     */
    public function parse($cssString);

    /**
     * @param string $path
     */
    public function parseFile($path);
}

interface igs_CssSelector
{}
