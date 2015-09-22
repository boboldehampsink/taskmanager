/**
 * Task Manager.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @license   MIT
 *
 */
(function($) {

  /**
   * Delete button
   */
  $('#content a[data-delete]').click(function() {
    e.preventDefault();

    // Make user confirm
    if (confirm(Craft.t('Are you sure you want to delete this task?'))) {

      // Delete via tasks controller
      Craft.postActionRequest('tasks/deleteTask', {
        taskId: $(this).data('delete'),
      }, function() {
        Craft.cp.displayNotice(Craft.t('Task deleted.'));
      });
    }
  });

}(jQuery));
