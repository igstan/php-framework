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
 * @category  Browser
 * @package   Browser
 * @uses      HTTP
 * @uses      DOM
 */

/**
 * @package Browser
 */
interface igs_Browser
{
    /**
     * @param  string
     * @return igs_Browser
     */
    public function navigateTo($url);

    /**
     * @return void
     */
    public function enableCookies();

    /**
     * @return void
     */
    public function disableCookies();

    /**
     * @return boolean
     */
    public function acceptsCookies();

    /**
     * @param  object $plugin
     * @return void
     */
    public function registerPlugin($plugin);

    /**
     * @return void
     */
    public function removePlugin($plugin);

    /**
     * @return array
     */
    public function plugins();

    /**
     * @return void
     */
    public function abortProcessing();
}

/**
 * @package Browser
 */
class igsd_Browser implements igs_Browser
{}

/**
 * @package Browser
 * @return  igs_Browser
 */
function igsd_Browser()
{
    return new igsd_Browser;
}

/**
 * TODO Implementation
 *
 * @package Browser
 */
interface igs_BrowserPlugin
{

}
