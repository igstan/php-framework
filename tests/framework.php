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

require_once 'library/components/dom.php';

class igs_DefaultDomDocumentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var igs_DefaultDomDocument
     */
    protected $dom;


    public function setUp()
    {
        $this->dom = igs_DefaultDomDocument();
        $this->dom->loadHTMLFile(dirname(__FILE__) . 'fixtures/default-dom-document.html');
    }

    public function testGetElementsByClassName1()
    {
        $classes = $dom->getElementsByClassName('get-elements-by-class-name');

        $this->assertType('igs_DomNodeList', $classes);
        $this->assertEquals(3, $classes->length);
        $this->assertEquals('Item 1', $classes->item(0)->textContent);
        $this->assertEquals('Item 3', $classes->item(1)->textContent);
        $this->assertEquals('Item 4', $classes->item(2)->textContent);
    }

    public function testGetElementsByClassName2()
    {
        $classes = $dom->getElementsByClassName('get-elements-by-class-name');

        // test Countable interface
        $this->assertType('Countable', $classes);
        $this->assertEquals(3, count($classes));

        // test ArrayAccess interface
        $this->assertType('ArrayAccess', $classes);
        $this->assertEquals('Item 1', $classes[0]->textContent);
        $this->assertEquals('Item 3', $classes[1]->textContent);
        $this->assertEquals('Item 4', $classes[2]->textContent);
    }

    public function testQuerySelector()
    {
        $row = $this->dom->querySelector('#big-table tbody tr:first');

        $this->assertNotNull($row);
        $this->assertEquals('Row 1', $row->textContent);
    }

    public function testQuerySelectorAll()
    {
        $rows = $this->dom->querySelectorAll('#big-table tbody tr');

        $this->assertType('igs_DomNodeList', $rows);
        $this->assertEquals(2, $rows->length);
        $this->assertEquals('Row 1', $rows->item(0)->textContent);
        $this->assertEquals('Row 2', $rows[1]->textContent);
    }
}
