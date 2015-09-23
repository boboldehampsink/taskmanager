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
class TaskManagerController extends BaseController
{
    /**
     * Allow anonymous access (for a cronjob perhaps).
     *
     * @var bool
     */
    public $allowAnonymous = true;

    /**
     * Rerun all failed tasks.
     */
    public function actionRerunAllFailedTasks()
    {
        // Get all failed tasks
        $tasks = craft()->db->createCommand()
            ->select('id')
            ->from('tasks')
            ->where(array('and', 'lft = 1', 'status = :status'), array(':status' => TaskStatus::Error))
            ->queryAll();

        // Loop through failed tasks
        foreach ($tasks as $task) {

            // Rerun task
            craft()->tasks->rerunTaskById($task['id']);
        }

        // Run pending tasks controller
        craft()->runController('tasks/runPendingTasks');
    }
}
