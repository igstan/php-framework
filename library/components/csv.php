<?php

interface igs_CsvReader extends ArrayAccess, Iterator
{
    /**
     * @param string $csvFile
     * @param array  $options OPTIONAL
     */
    public function __construct($csvFile, array $options = array());
}

interface igs_CsvWriter
{}
