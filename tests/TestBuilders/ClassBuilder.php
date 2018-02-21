<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace PhUml\TestBuilders;

use PhUml\Code\Attributes\Attribute;
use PhUml\Code\ClassDefinition;
use PhUml\Code\Methods\Method;
use PhUml\Code\Name;
use PhUml\Code\Variables\TypeDeclaration;
use PhUml\Code\Variables\Variable;
use PhUml\Fakes\NumericIdClass;

class ClassBuilder extends DefinitionBuilder
{
    /** @var Name */
    protected $parent;

    /** @var Attribute[] */
    private $attributes = [];

    /** @var Method[] */
    private $methods = [];

    /** @var Name[] */
    private $interfaces = [];

    public function withAPublicAttribute(string $name, string $type = null): ClassBuilder
    {
        $this->attributes[] = Attribute::public($name, TypeDeclaration::from($type));

        return $this;
    }

    public function withAProtectedAttribute(string $name, string $type = null): ClassBuilder
    {
        $this->attributes[] = Attribute::protected($name, TypeDeclaration::from($type));

        return $this;
    }

    public function withAPrivateAttribute(string $name, string $type = null): ClassBuilder
    {
        $this->attributes[] = Attribute::private($name, TypeDeclaration::from($type));

        return $this;
    }

    public function withAProtectedMethod(string $name, Variable ...$parameters): ClassBuilder
    {
        $this->methods[] = Method::protected($name, $parameters);

        return $this;
    }

    public function withAPrivateMethod(string $name, Variable ...$parameters): ClassBuilder
    {
        $this->methods[] = Method::private($name, $parameters);

        return $this;
    }

    public function withAPublicMethod(string $name, Variable ...$parameters): ClassBuilder
    {
        $this->methods[] = Method::public($name, $parameters);

        return $this;
    }

    public function withAMethod(Method $method): ClassBuilder
    {
        $this->methods[] = $method;

        return $this;
    }

    public function extending(Name $parent): ClassBuilder
    {
        $this->parent = $parent;

        return $this;
    }

    public function implementing(Name ...$interfaces): ClassBuilder
    {
        $this->interfaces = array_merge($this->interfaces, $interfaces);

        return $this;
    }

    /** @return ClassDefinition */
    public function build()
    {
        return new ClassDefinition(
            Name::from($this->name),
            $this->methods,
            $this->constants,
            $this->parent,
            $this->attributes,
            $this->interfaces
        );
    }

    /** @return NumericIdClass */
    public function buildWithNumericId()
    {
        return new NumericIdClass(
            Name::from($this->name),
            $this->constants,
            $this->methods,
            $this->parent,
            $this->attributes,
            $this->interfaces
        );
    }
}
