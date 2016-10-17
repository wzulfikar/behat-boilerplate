<?php

/**
* [assertEquals description]
* 
* @param  [type] $expected [description]
* @param  [type] $actual   [description]
* @param  string $msg  [description]
* @return [type]           [description]
*/
function assertEquals($expected, $actual, $msg = null)
{    
  if( gettype($expected) != gettype($actual) )
    throwException($msg ?: '!! Expected ' . gettype($expected) . ' instead of ' . gettype($actual), $actual);

  if( is_array($expected) ){
    
    if(count($expected) != count($actual) )
      throwException($msg ?: '!! Expected ' . count($expected) . ' array(s) instead of ' . count($actual), $actual);

    foreach ($expected as $key => $val) {
      if(!isset($actual[$key]))
        throwException($msg ?: sprintf('!! Expected %s => %s instead of undefined', $key, $val), $actual);       

      if($val != $actual[$key])
        throwException($msg ?: sprintf('!! Expected %s => %s instead of %s => %s', $key, $val, $key, $actual[$key]), $actual);
    }
  }

  if( $expected != $actual )
    throwException($msg ?: "!! Expected: " . $expected, $actual);
}

function throwException($msg, $actual)
{
  throw new Exception( $msg . "\nActual output:\n", var_dump($actual) );
}