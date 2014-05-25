<?php get_header(); 
?>

<div class="row">
  <div class="col-md-8"> 
    <div class="modal fade" id="opt-in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<div class="container">
          <h4 class="modal-title">Get Free Updates</h4>
	</div>
      </div>
      <div class="modal-body">
	<?php echo do_shortcode( '[mc4wp_form]' ) ; ?>
        <?php // echo do_shortcode( '[gravityform class="container" id="1" name="Opt-in" title="false" description="false"]' ); 
	?>
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#opt-in').modal('show');
    });
</script>

  </div>
  <div class="col-md-4">
    <?php get_sidebar() ;?>
  </div>
</div>

<?php get_footer(); ?>
