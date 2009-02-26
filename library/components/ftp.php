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
 */

interface igs_FtpClient
{
    /**
     * @param string  $host
     * @param string  $user
     * @param string  $pass
     * @param integer $port    OPTIONAL Defaults to 21
     * @param integer $timeout OPTIONAL Defaults to 90 seconds
     */
    public function __construct($host, $user, $pass, $port = 21, $timeout = 90);

    /**
     * @param  string $fromServer
     * @param  string|igs_File|igs_Directory $toLocal
     * @return void
     * @throws Exception
     */
    public function download($fromServer, $toLocal);

    /**
     * @param  string|igs_File|igs_Directory $fromLocal
     * @param  string $toServer
     * @return void
     * @throws Exception
     */
    public function upload($fromLocal, $toServer);

    /**
     * @param  integer $quota
     * @return igs_FtpClient
     */
    public function allocateSpace($quota);

    /**
     * @param  string $newDirectory
     * @return igs_FtpClient
     */
    public function changeDirectory($newDirectory);

    /**
     * @param  string $directoryName
     * @return igs_FtpClient
     */
    public function createDirectory($directoryName);

    /**
     * @param  string $rawCommand
     * @return mixed
     */
    public function sendCommand($rawCommand);
}

interface igs_FtpFile extends ArrayAccess, Iterator
{}

interface igs_FtpDirectory extends Countable, ArrayAccess, Iterator
{}
