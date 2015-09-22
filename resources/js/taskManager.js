/**
 * Task Manager.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @license   MIT
 *
 */
(function($) {
  'use strict';

  /**
   * Restart button
   */
  $('#content').on('click', 'a.restart', function(e) {
    e.preventDefault();

    // Make user confirm
    if (confirm(Craft.t('Are you sure you want to restart this task?'))) {

      // Delete via tasks controller
      Craft.postActionRequest('tasks/rerunTask', {
        taskId: $(this).closest('tr').data('id'),
      }, $.proxy(function() {
        Craft.cp.displayNotice(Craft.t('Task restarted.'));
      }, this));
    }
  });

  /**
   * Delete button
   */
  $('#content').on('click', 'a.delete', function(e) {
    e.preventDefault();

    // Make user confirm
    if (confirm(Craft.t('Are you sure you want to delete this task?'))) {

      // Delete via tasks controller
      Craft.postActionRequest('tasks/deleteTask', {
        taskId: $(this).closest('tr').data('id'),
      }, $.proxy(function() {
        Craft.cp.displayNotice(Craft.t('Task deleted.'));
        $(this).closest('tr').remove();
      }, this));
    }
  });

}(jQuery));
