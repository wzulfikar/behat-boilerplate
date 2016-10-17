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

// include file which contains function we want to test
require_once 'src/parseTitleDesc.php';

// include helper for simple assert
require_once 'helpers/assert.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $scene1 = [];
    private $scene2 = [];

    private $scene = [];
    
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

    /**
     * @Given /^the function parseTitleDesc is callable$/
     */
    public function theFunctionParsetitledescIsCallable()
    {
        return is_callable('parseTitleDesc');
    }

    /**
     * @Given /^the parameter passed is "([^"]*)"$/
     */
    public function theParameterPassedIs($arg1)
    {
        $this->scene1['param'] = $arg1;
    }

    /**
     * @Then /^it should return array$/
     */
    public function itShouldReturnArray()
    {
        assertEquals( gettype([]), gettype(parseTitleDesc($this->scene1['param'])) );
    }

    /**
     * @Given /^the title is "([^"]*)" and desc is empty$/
     */
    public function theTitleIsAndDescIsEmpty($arg1)
    {
        assertEquals([['title'=>'bdr7567', 'desc'=>'']], parseTitleDesc($this->scene1['param']));
    }
    
    /**
     * @Given /^the receipt of second scene is "([^"]*)"$/
     */
    public function theReceiptOfSecondSceneIs($arg1)
    {
        $this->scene2['receipt'] = $arg1;
    }

    /**
     * @Then /^it should get title "([^"]*)"  and desc "([^"]*)" for second scene$/
     */
    public function itShouldGetTitleAndDescForSecondScene($arg1, $arg2)
    {
        assertEquals([['title'=>$arg1, 'desc'=>$arg2]], parseTitleDesc($this->scene2['receipt']));
    }
    

    /**
     * @Given /^the receipt format is formal "([^"]*)" or arbitrary space "([^"]*)" or no space "([^"]*)"$/
     */
    public function theReceiptFormatIsFormalOrArbitrarySpaceOrNoSpace($arg1, $arg2, $arg3)
    {
        $this->scene['multiple_items']['receipts']['formal']   = parseTitleDesc($arg1);
        $this->scene['multiple_items']['receipts']['arbitrary_space'] = parseTitleDesc($arg2);
        $this->scene['multiple_items']['receipts']['no_space'] = parseTitleDesc($arg3);
    }

    /**
     * @Then /^total number of receipts should be (\d+)$/
     */
    public function totalNumberOfReceiptsShouldBe($arg1)
    {
        assertEquals(intval($arg1), count($this->scene['multiple_items']['receipts']['formal']));
        assertEquals(intval($arg1), count($this->scene['multiple_items']['receipts']['arbitrary_space']));
        assertEquals(intval($arg1), count($this->scene['multiple_items']['receipts']['no_space']));
    }

    /**
     * @Given /^should get title "([^"]*)" desc "([^"]*)" for receipt (\d+)$/
     */
    public function shouldGetTitleDescForReceipt($arg1, $arg2, $arg3)
    {
        assertEquals(['title'=>$arg1, 'desc'=>$arg2], $this->scene['multiple_items']['receipts']['formal'][$arg3-1]);
        assertEquals(['title'=>$arg1, 'desc'=>$arg2], $this->scene['multiple_items']['receipts']['arbitrary_space'][$arg3-1]);
        assertEquals(['title'=>$arg1, 'desc'=>$arg2], $this->scene['multiple_items']['receipts']['no_space'][$arg3-1]);
    }
}