<?php

/**
 * Cover class_attributes_separation.
 */
class Sample {

    public $a;

    #[SetUp]
    public $b;

    /**
     * @var string
     */
    public $c;

    /**
     * @internal
     */
    #[Assert\String()]
    public $d;

    public $e;

    private $a; // foo

    protected function bar() {}

    protected function foo() {}

}
