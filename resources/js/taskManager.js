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
