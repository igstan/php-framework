<?php
/**
 * Copyright (c) 2009, Ionut Gabriel Stan. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *    * Redistributions of source code must retain the above copyright notice,
 *      this list of conditions and the following disclaimer.
 *
 *    * Redistributions in binary form must reproduce the above copyright notice,
 *      this list of conditions and the following disclaimer in the documentation
 *      and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author    Ionut G. Stan <ionut.g.stan@gmail.com>
 * @license   New BSD license
 * @copyright Copyright (c) 2009, Ionut Gabriel Stan. All rights reserved.
 * @category  FileSystem
 */

// TODO Implementation

class igs_FileNotFoundException extends Exception
{}

interface igs_File extends ArrayAccess, Iterator
{
    /**
     * @param  string $path OPTIONAL
     * @throws igs_FileNotFoundException
     */
    public function __construct($path = null)
    {}
}

class igs_DefaultFile implements igs_File
{}

/**
 * @param  string $path OPTIONAL
 * @return igs_File
 * @throws igs_FileNotFoundException
 */
function igs_DefaultFile($path = null)
{
    return new igs_File($path);
}

interface igs_Directory extends Countable, ArrayAccess, Iterator
{}

class igs_DefaultDirectory implements igs_Directory
{}

/**
 * @param  string $path OPTIONAL
 * @return unknown
 * @throws igs_FileNotFoundException
 */
function igs_DefaultDirectory($path = null)
{
    return new igs_DefaultDirectory($path = null);
}
