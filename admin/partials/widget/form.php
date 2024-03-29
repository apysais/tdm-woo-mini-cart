<p>
<label for="<?php echo esc_attr( $get_field_id_title ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
<input class="widefat" id="<?php echo esc_attr( $get_field_id_title ); ?>" name="<?php echo esc_attr( $get_field_name_title ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
<label for="<?php echo esc_attr( $get_field_id_template ); ?>"><?php esc_attr_e( 'Choose Template :'); ?></label>
<select name="<?php echo esc_attr( $get_field_name_template ); ?>">
<?php foreach($template_select as $k => $v){ ?>
        <option value="<?php echo $k;?>" <?php echo ($template == $k) ? 'selected':'';?> ><?php echo $v;?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo esc_attr( $get_field_id_custom_main_class ); ?>"><?php esc_attr_e( 'Custom Main Class:'); ?></label>
<input class="widefat" id="<?php echo esc_attr( $get_field_id_custom_main_class ); ?>" name="<?php echo esc_attr( $get_field_name_custom_main_class ); ?>" type="text" value="<?php echo esc_attr( $custom_main_class ); ?>">
</p>
