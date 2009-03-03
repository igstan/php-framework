<?php

interface igs_WritableStream
{
    public function write($data);
}

interface igs_ReadableStream
{
    public function read($bytes = null);
}

interface igs_Stream extends igs_WritableStream, igs_ReadableStream
{}
