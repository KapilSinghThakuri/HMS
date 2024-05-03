$(document).ready(function() {
    var $menuTypeSelect = $('#menu_type_select');

    var $modelDiv = $('.model-div');
    var $pageDiv = $('.page-div');
    var $externalLinkDiv = $('.external-link-div');

    function toggleVisibility() {
        var selectedValue = $menuTypeSelect.val();

        $modelDiv.toggle(selectedValue === '1');
        $pageDiv.toggle(selectedValue === '2');
        $externalLinkDiv.toggle(selectedValue === '3');
    }

    $menuTypeSelect.on('change', toggleVisibility);

    toggleVisibility();
});
