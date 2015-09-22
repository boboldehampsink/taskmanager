Task Manager plugin for Craft CMS [![Build Status](https://travis-ci.org/boboldehampsink/taskmanager.svg?branch=develop)](https://travis-ci.org/boboldehampsink/taskmanager) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/boboldehampsink/taskmanager/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/boboldehampsink/taskmanager/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/boboldehampsink/taskmanager/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/boboldehampsink/taskmanager/?branch=develop) [![Latest Stable Version](https://poser.pugx.org/boboldehampsink/taskmanager/v/stable)](https://packagist.org/packages/boboldehampsink/taskmanager) [![Total Downloads](https://poser.pugx.org/boboldehampsink/taskmanager/downloads)](https://packagist.org/packages/boboldehampsink/taskmanager) [![Latest Unstable Version](https://poser.pugx.org/boboldehampsink/taskmanager/v/unstable)](https://packagist.org/packages/boboldehampsink/taskmanager) [![License](https://poser.pugx.org/boboldehampsink/taskmanager/license)](https://packagist.org/packages/boboldehampsink/taskmanager)
=================

Adds a "Task Manager" section to your CP to easily cancel or delete Craft Tasks.

__Important__  
 - The plugin's folder should be named "taskmanager"  

Development
=================
Run this from your Craft installation to test your changes to this plugin before submitting a Pull Request
```bash
phpunit --bootstrap craft/app/tests/bootstrap.php --configuration craft/plugins/taskmanager/phpunit.xml.dist --coverage-clover coverage.clover craft/plugins/taskmanager/tests
```

Changelog
=================
###0.2.0###
 - Added the ability to restart a task
 - Deleting a task is now more graceful

###0.1.0###
 - Initial release
