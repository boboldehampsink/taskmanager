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
class TaskManagerCommand extends BaseCommand
{
    /**
     * Runs pending tasks.
     *
     * @return int
     */
    public function actionRun()
    {
        Craft::log(Craft::t('Running new tasks.'));

        // Make sure tasks aren't already running
        if (!craft()->tasks->isTaskRunning()) {

            // Is there a pending task?
            if (craft()->tasks->getNextPendingTask()) {

                // Start running tasks
                craft()->tasks->runPendingTasks();

                return 1;
            } else {
                Craft::log(Craft::t('No pending tasks found.'));
            }
        } else {
            Craft::log(Craft::t('Tasks are already running.'));
        }

        return 0;
    }

    /**
     * Watch for tasks and run them.
     */
    public function actionWatch()
    {
        Craft::log(Craft::t('Watching for new tasks.'));

        // Keep on checking for pending tasks
        while (true) {

            // Make sure tasks aren't already running
            if (!craft()->tasks->isTaskRunning()) {

                // Reset next pending tasks cache
                $this->resetCraftNextPendingTasksCache();

                // Is there a pending task?
                if (craft()->tasks->getNextPendingTask()) {

                    // Start running tasks
                    craft()->tasks->runPendingTasks();
                } else {
                    Craft::log(Craft::t('No pending tasks found.'));
                }
            } else {
                Craft::log(Craft::t('Tasks are already running, skipping iteration.'));
            }

            // Sleep a little
            sleep(10);
        }
    }

    /**
     * Reset craft next pending task cache using reflection.
     */
    private function resetCraftNextPendingTasksCache()
    {
        $obj = craft()->tasks;
        $refObject = new \ReflectionObject($obj);
        $refProperty = $refObject->getProperty('_nextPendingTask');
        $refProperty->setAccessible(true);
        $refProperty->setValue($obj, null);
    }
}
