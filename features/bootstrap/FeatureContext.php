<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

// third-party lib
// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

// include helper for simple assert
require_once 'helpers/assert.php';

// include file which contains function we want to test
// require_once 'src/filename.php';

/**
* Features context.
*/
class FeatureContext extends BehatContext
{
  /**
   * Initializes context.
   * Every scenario gets its own context object.
   *
   * @param array $parameters context parameters (set them up through behat.yml)
   */
  public function __construct(array $parameters)
  {
    // Initialize your context here
  }
  
//
//  Place your definition and hook methods here:
//
//  /**
//   * @Given /^I have done something with "([^"]*)"$/
//   */
//  public function iHaveDoneSomethingWith($argument)
//  {
//    doSomethingWith($argument);
//  }

}
