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
     * Delete task.
     */
    public function actionDeleteTask()
    {
        // Require permissions
        craft()->userSession->requirePermission('accessCp');

        // Get task id
        $taskId = craft()->request->getRequiredParam('taskId');

        // Delete task
        if (craft()->tasks->deleteTaskById($taskId)) {
            craft()->userSession->setNotice(Craft::t('Task deleted.'));
        } else {
            craft()->userSession->setError(Craft::t('Task could not be deleted.'));
        }

        // Redirect to overview
        $this->redirect(UrlHelper::getCpUrl('taskmanager'));
    }
}
