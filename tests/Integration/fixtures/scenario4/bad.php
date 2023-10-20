<?php

/**
 * Cover class_attributes_separation
 */
class Sample
{private $a; // foo
    public $a;
    #[SetUp]
    public $b;
    /** @var string */
    public $c;
    /** @internal */
    #[Assert\String()]
    public $d;

    public $e;

    protected function foo()
    {
    }
    protected function bar()
    {
    }
}
