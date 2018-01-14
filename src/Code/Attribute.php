<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace PhUml\Code;

class Attribute extends Variable
{
    private static $symbols = [
        'private' => '-',
        'public' => '+',
        'protected' => '#',
    ];

    /** @var string */
    public $modifier;

    public function __construct(string $name, string $modifier, TypeDeclaration $type = null)
    {
        parent::__construct($name, $type);
        $this->modifier = $modifier;
    }

    public static function public(string $name, string $type = null): Attribute
    {
        return new Attribute($name, 'public', TypeDeclaration::from($type));
    }

    public static function protected(string $name, string $type = null): Attribute
    {
        return new Attribute($name, 'protected', TypeDeclaration::from($type));
    }

    public static function private(string $name, string $type = null): Attribute
    {
        return new Attribute($name, 'private', TypeDeclaration::from($type));
    }

    /**
     * It doesn't currently support information type
     *
     * @see GraphvizProcessor#getClassDefinition In its original version
     */
    public function __toString()
    {
        return sprintf('%s%s', self::$symbols[$this->modifier], $this->name);
    }
}
