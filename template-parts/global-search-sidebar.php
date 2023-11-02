
<?php
if (!is_search()) {
    get_critical_css('search-widget.min.css');
    if (is_active_sidebar('glogal-search')) {
        dynamic_sidebar('glogal-search');
    }
}
?>