/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal) {

  'use strict';

  Drupal.behaviors.bootstrap_sass = {
    attach: function(context, settings) {

      // Custom code here

    }
  };

  Drupal.behaviors.collapseParagraphsOnAdd = {
    attach: function (context, settings) {
      $('.paragraphs-subform.form-wrapper', context).once('collapse-paragraph').each(function () {
        // Find the collapse button by its class
        var $collapseBtn = $(this).find('.paragraphs-icon-button-collapse');
        if ($collapseBtn.length && $collapseBtn.is(':visible')) {
          $collapseBtn.trigger('click');
        }
      });
    }
  };

})(jQuery, Drupal);