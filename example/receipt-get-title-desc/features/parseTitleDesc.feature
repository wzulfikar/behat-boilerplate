# features/default.feature
Feature: Parse title and desc from given string of receipt
  In order to parse title and desc
  As a user
  I need to pass string of receipt

Scenario: initial check
  Given the function parseTitleDesc is callable
  And the parameter passed is "bdr7567"
  Then it should return array 
  And the title is "bdr7567" and desc is empty

Scenario: Parse title with desc
  Given the receipt of second scene is "bdr7567 madura"
  Then it should get title "bdr7567"  and desc "madura" for second scene 

Scenario: Get receipt with multiple items
  Given the receipt format is formal "bdr7567.1.2 madura" or arbitrary space " bdr7567 .1 .2madura" or no space "bdr7567.1.2madura"
  Then total number of receipts should be 2
  And should get title "bdr7567.1" desc "madura" for receipt 1
  And should get title "bdr7567.2" desc "madura" for receipt 2