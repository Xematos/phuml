<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace PhUml\Graphviz\Builders;

use PhUml\Code\InterfaceDefinition;
use PhUml\Graphviz\InheritanceEdge;
use PhUml\Graphviz\Node;

/**
 * It produces the collection of nodes and edges related to an interface
 *
 * It creates a node with the interface itself
 * It creates an edge using the interface it extends, if any
 */
class InterfaceGraphBuilder
{
    /**
     * The order in which the nodes and edges are created is as follows
     *
     * 1. The node representing the interface itself
     * 2. The parent interface, if any
     *
     * @return \PhUml\Graphviz\HasDotRepresentation[]
     */
    public function extractFrom(InterfaceDefinition $interface): array
    {
        $dotElements = [];

        $dotElements[] = new Node($interface);

        if ($interface->hasParent()) {
            $dotElements[] = new InheritanceEdge($interface->extends(), $interface);
        }

        return $dotElements;
    }
}
