<?php

do_action('acf/input/admin_head'); // Add ACF admin head hooks
do_action('acf/input/admin_enqueue_scripts'); // Add ACF scripts

$options = array(
    'id' => 'acf-form',
    'post_id' => 'options',
    'new_post' => false,
    'field_groups' => array( 'group_5d6f92196831a' ),
    'return' => admin_url('admin.php?page=opcoes/opcoes.php'),
    'submit_value' => 'Update',
);

?>

<div class="wrap">
<h2>Opções</h2>

<?php 

acf_form( $options );

?>
</div>