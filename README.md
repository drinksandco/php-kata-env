# php-kata-env

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/uvinum/php-kata-env.svg?branch=master)](https://travis-ci.org/uvinum/php-kata-env)
[![Code Coverage](https://scrutinizer-ci.com/g/uvinum/php-kata-env/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/uvinum/php-kata-env/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/uvinum/php-kata-env/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/uvinum/php-kata-env/?branch=master)

# Introduction 

Here is the bad news: you are in charge of maintaining a new legacy app. The code is horrible, atrocious.
No one can understand what it does. 

The good news: at least there are unit tests to prove the code is working. 

You job is to refactor the code and make it readable, while keeping the code in working order (pass all tests). 

# How To Start

1. Clone this repository `git clone $ git clone git@github.com:uvinum/php-kata-env.git`
2. Run the tests with `composer test-unit`
3. Start refactoring! 

The primary goal is to refactor the code in `src/Algorithm/Finder.php` - as it stands the code is incomprehensible. 

# Tips

* Start with simple rename refactors so you can better understand the abstractions you are working with. Rename any class or any variable. 
* Move on to extract methods and making the code more modular.
* See if you can also eliminate switch statements and multiple exit points from methods. 

Anything is fair game, create new classes, new methods, and rename tests. 
The only restriction is that the existing tests have to keep working. 
Lean on the tests and run them after every small change to make sure you are on the right path.

# How to End

You can stop when you feel the code is good enough, something you can come back to in 6 months and understand. 

# Helpful resources

## Refactoring

* [Refactoring.guru Code Smells catalog](https://refactoring.guru/smells/smells)
* [Refactoring.guru Refactorings catalog](https://refactoring.guru/catalog)
* [SourceMaking Refactorings catalog](https://sourcemaking.com/refactoring)
* [Martin Fowler Refactorings catalog](http://refactoring.com/catalog/)

# Credits and other programming languages

This kata is a PHP port of [the original Incomprehensible Finder Refactoring Kata](https://github.com/OdeToCode/Katas/tree/master/Refactoring) created by [K. Scott Allen](https://github.com/OdeToCode).

This port has been developed by [CodelyTV](http://codely.tv/) in order to have it available for the [Software Craftsmanship Barcelona Coding Dojo session](http://www.meetup.com/Barcelona-Software-Craftsmanship/events/233107734/).
