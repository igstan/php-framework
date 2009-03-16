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
 * @category  IO
 * @package   IO
 */

/**
 * @package IO
 */
class igs_FileNotFoundException extends Exception
{}

/**
 * @package IO
 */
interface igs_File extends ArrayAccess, Iterator
{
    /**
     * @param  string $path OPTIONAL
     * @throws igs_FileNotFoundException
     */
    public function __construct($path = null)
    {}
}

/**
 * @package IO
 */
class igsd_File implements igs_File
{}

/**
 * @package IO
 * @param   string $path OPTIONAL
 * @return  igs_File
 * @throws  igs_FileNotFoundException
 */
function igsd_File($path = null)
{
    return new igsd_File($path);
}

/**
 * @package IO
 */
interface igs_Directory extends Countable, ArrayAccess, Iterator
{}

/**
 * @package IO
 */
class igsd_Directory implements igs_Directory
{}

/**
 * @package IO
 * @param   string $path OPTIONAL
 * @return  igsd_Directory
 * @throws  igs_FileNotFoundException
 */
function igsd_Directory($path = null)
{
    return new igsd_Directory($path = null);
}
