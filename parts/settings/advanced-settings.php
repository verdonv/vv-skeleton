<?php
/*
Title: VV Skeleton Settings Section
Setting: vv_skeleton
Tab: Advanced
*/

piklist('field', array(
    'type' => 'datepicker'
    ,'scope' => 'post_meta'
    ,'field' => 'field_name'
    ,'label' => 'Example Field'
    ,'description' => 'Click in box'
    ,'attributes' => array(
        'class' => 'text'
        )
    ,'options' => array(
        'dateFormat' => 'M d, y'
        )
    ,'value' => date('M d, y', time() + 604800)
    ,'position' => 'wrap'
));

?>
