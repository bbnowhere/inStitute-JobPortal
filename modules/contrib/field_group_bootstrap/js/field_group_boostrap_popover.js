/**
 * @file
 */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => {
  const selector = popoverTriggerEl.getAttribute('data-bs-custom-content');
  const parentElement = popoverTriggerEl.closest('div');
  const content = parentElement.querySelector(selector).innerHTML;
  return new bootstrap.Popover(popoverTriggerEl, {
    html: true,
    trigger: 'focus',
    content: content
  });
});
