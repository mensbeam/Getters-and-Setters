<?php
/**
 * @license MIT
 * Copyright 2023 Dustin Wilson, J. King et al.
 * See LICENSE and AUTHORS files for details
 */

declare(strict_types=1);
namespace MensBeam\Foundation\TestCase;
use MensBeam\Foundation\GettersAndSetters;


/** @covers \MensBeam\Foundation\GettersAndSetters */
class TestGettersAndSetters extends \PHPUnit\Framework\TestCase {
    public function provideFailures__errors(): iterable {
        $ook = new class {
            use GettersAndSetters;
            protected ?string $_eek = 'eek';
            protected ?string $_ook = 'ook';


            protected function __get_eek(): ?string {
                return $this->_eek;
            }

            protected function __get_ook(): ?string {
                return $this->_ook;
            }

            protected function __set_ook(?string $value): void {
                $this->_ook = $value;
            }
        };

        return [
            [ function() use($ook) {
                $ook->eek = 'ook';
             } ],

            [ function() use($ook) {
                unset($ook->eek);
            } ]
        ];
    }

    /**
     * @dataProvider provideFailures__errors
     * @covers \MensBeam\Foundation\GettersAndSetters::__get
     * @covers \MensBeam\Foundation\GettersAndSetters::__set
     * @covers \MensBeam\Foundation\GettersAndSetters::__unset
     */
    public function testFailures__errors(\Closure $closure): void {
        $this->expectException(\Error::class);
        $closure();
    }


    public function provideFailures__warnings(): iterable {
        $ook = new class {
            use GettersAndSetters;
            protected ?string $_eek = 'eek';
            protected ?string $_ook = 'ook';


            protected function __get_eek(): ?string {
                return $this->_eek;
            }

            protected function __get_ook(): ?string {
                return $this->_ook;
            }

            protected function __set_ook(?string $value): void {
                $this->_ook = $value;
            }
        };

        return [
            [ function() use($ook) {
                $ook->ack;
            } ],

            [ function() use($ook) {
                $ook->ack = 'ack';
            } ]
        ];
    }

    /**
     * @dataProvider provideFailures__warnings
     * @covers \MensBeam\Foundation\GettersAndSetters::__get
     * @covers \MensBeam\Foundation\GettersAndSetters::__set
     * @covers \MensBeam\Foundation\GettersAndSetters::__unset
     */
    public function testFailures__warnings(\Closure $closure): void {
        $this->expectWarning();
        $closure();
    }


    /** @covers \MensBeam\Foundation\GettersAndSetters::__isset */
    public function testIsset(): void {
        $ook = new class {
            use GettersAndSetters;

            protected function __get_ook(): ?string {
                return 'ook';
            }
        };

        $this->assertTrue(isset($ook->ook));
    }


    /** @covers \MensBeam\Foundation\GettersAndSetters::__unset */
    public function testUnset(): void {
        $ook = new class {
            use GettersAndSetters;
            protected ?string $_ook = 'ook';


            protected function __get_ook(): ?string {
                return $this->_ook;
            }

            protected function __set_ook(?string $value): void {
                $this->_ook = $value;
            }
        };

        unset($ook->ook);
        $this->assertNull($ook->ook);
    }


    /** @covers \MensBeam\Foundation\GettersAndSetters::__set */
    public function testSet(): void {
        $ook = new class {
            use GettersAndSetters;
            protected ?string $_ook = 'ook';


            protected function __get_ook(): ?string {
                return $this->_ook;
            }

            protected function __set_ook(?string $value): void {
                $this->_ook = $value;
            }
        };

        $ook->ook = 'eek';
        $this->assertSame('eek', $ook->ook);
    }
}