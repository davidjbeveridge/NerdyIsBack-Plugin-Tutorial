<?php
extract($GLOBALS);
@include(ABSPATH.'/wp-admin/admin-header.php');
$this->renderChildren();
@include(ABSPATH.'/wp-admin/admin-footer.php');