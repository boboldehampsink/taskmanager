<?php

namespace Craft;

/**
 * Task Manager.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Bob Olde Hampsink
 * @license   MIT
 *
 * @link      http://github.com/boboldehampsink
 */
return array(

    // How long should we wait before we forfeit a task as hanging?
    'taskTimeout' => 0,

    // At what interval should the watcher watch for new tasks? (in seconds)
    'taskInterval' => 10
);
