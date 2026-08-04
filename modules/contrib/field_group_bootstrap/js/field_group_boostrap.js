/**
 * @file
 */

(($, Drupal, cookies, once) => {
  Drupal.behaviors.field_group_bootstrap = {
    attach: (context, settings) => {
      function memoryClick(type = '', currentTab, currentGroup) {
        // Retrieve a cookie.
        let cookiesType = cookies.get(type);
        if (cookiesType) {
          cookiesType = JSON.parse(cookiesType);
        } else {
          cookiesType = {};
        }
        cookiesType[currentGroup] = currentTab;
        // Set a cookie.
        cookies.set(type, JSON.stringify(cookiesType));
      }

      function childFirstClick(selector) {
        let navFirst = $(selector).first();
        navFirst.trigger('click');
        let control = navFirst.attr('aria-controls');
        $('#'+control+' .nav-link').first().trigger('click');
      }
      // Active first tabs.
      $(once('bootstrap-tabs', '.field-group-bootstrap_tabs-wrapper', context)).each(function () {
        let bootstrap_tabs = cookies.get('bootstrap_tabs');
        if (bootstrap_tabs) {
          let tabs = JSON.parse(bootstrap_tabs);
          $.each(tabs, function (key, tab) {
            let selectorTab = '.field-group-bootstrap_tabs-wrapper .nav-link[aria-controls="' + tab + '"]';
            if ($(selectorTab).length) {
              $(selectorTab).click();
            }
          });
        } else {
          childFirstClick('.field-group-bootstrap_tabs-wrapper .nav-link');
        }
      });

      // Fixed ajax tabs.
      $(once('bootstrap-tabs-nav-link', '.field-group-bootstrap_tabs-wrapper .nav .nav-link', context)).each(function () {
        let target = $(this).data('bsTarget').replace('#', '');
        let id = $(`[data-drupal-selector="${target}"]`).attr('id');
        if (id != target) {
          $(`[data-drupal-selector="${target}"]`).attr('id', target);
        }
        // Memory when click on tab.
        $(this).click(function () {
          let tabs = [];
          $('.fg-bootstrap-tab.active').each(function (index, element) {
            tabs.push($(element).attr('aria-controls'));
          });
          cookies.set('bootstrap_tabs', JSON.stringify(tabs));
        });
      });

      // Memory when click on list item scrollby.
      $(once('bootstrap-tabs-list-group', '.field-group-bootstrap_scrollby-wrapper .list-group .list-group-item', context)).click(function () {
        memoryClick('bootstrap_scrollby', $(this).data('controls'), $(this).data('group'));
      });

      // Memory when click on accordion.
      $(once('bootstrap-tabs-accordion', '.field-group-bootstrap_accordion-wrapper .accordion-button', context)).each(function () {
        let target = $(this).data('bsTarget').replace('#', '');
        let id = $(`[data-drupal-selector="${target}"]`).attr('id');
        if (id != target) {
          $(`[data-drupal-selector="${target}"]`).attr('id', target);
        }
        let that = $(this)
        $(this).click(function () {
          memoryClick('bootstrap_accordion', that.data('controls'), that.data('group'));
        });
      });

      // Tab nav.
      $(once('tab-content', '.tab-content', context)).each(function () {
        let $tabContent = $(this);
        $tabContent.siblings('.bootstrap-tab').each(function () {
          $tabContent.append($(this));
        });
      });
    },
  };
})(jQuery, Drupal, window.Cookies, once);
