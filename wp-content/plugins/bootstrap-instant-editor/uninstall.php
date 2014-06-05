<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
{
  exit() ;
}

delete_option( 'rkbc_theplugin_options' ) ;

?>