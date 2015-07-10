<?php 
/*
	plugin-main-class
 */
	class Pr_Responsive_Gallery {

		function  __construct(){

				add_action( 'wp_enqueue_script', array($this,'enqueue_style') );
				add_action( 'wp_enqueue_script', array($this,'enqueue_script') );
				add_action( 'init', array($this,'create_post_type') );
				add_shortcode( 'pr-responsive-gallery' , array($this, 'render_short_code'));
				add_action('admin_enqueue_scripts', array($this, 'load_menu_scripts') );
				// add_action('admin_menu' , array($this, 'brdesign_enable_pages')); 
				add_action( 'admin_init', array($this, 'portfolio_settings') );
				add_action( 'add_meta_boxes', array($this, 'add_events_metaboxes') );
				add_action( 'wp_enqueue_script', array($this,'enqueue_style_metabox') );
				add_action('wp_ajax_saving_gallery_images', array($this, 'saving_gallery_images') );
				
		
		}
		function saving_gallery_images(){
			if (isset($_REQUEST)) {
				update_option( 'pr_save_images', $_REQUEST['images'] );
			}
		}
// adding media uploader
	function load_menu_scripts(){

			wp_enqueue_media( 'media-upload' );
			wp_enqueue_script( 'custom-script', plugins_url( 'admin/admin.js', __FILE__ ), array('jquery'));
			wp_localize_script( 'custom-script', 'urls', array( 'ajax' => admin_url( 'admin-ajax.php' )));
			
		}
	

		// adding portfolio settings
		function portfolio_settings(){
			register_setting( 'image_resizer_group', 'nm_image_settings' );
		}

		// adding settin menu page into custom post type
		// function brdesign_enable_pages(){
		// 	add_submenu_page('edit.php?post_type=gallery', 'Custom Post Type Admin', 'Custom Settings', 'manage_options', basename(__FILE__), array($this , 'custom_function'));
		// }
		// adding meta box 
		function add_events_metaboxes(){

			add_meta_box('wpt_events_location', 'Event Location', array($this,  'wpt_events_location'), 'gallery', 'normal', 'default');
		}

		function wpt_events_location(){
			$all_images = get_option('pr_save_images' );
			

			?>	

			<style>
				.img-pup{
					width: 100px;
					height: 100px;
					float: left;
					margin-right: 10px;
					position: relative;
					top: 10px;


				}
				.img-pup img {
					  width: 100%;
					  height: 85%;
				}
				.clear-fix{
					clear: both;
				}
				.img-gallery{
					width: 100px;
					height: 100px;
					float: left;
					margin-right: 10px;
					position: absolute;
				}
				.dashicons{
					  
					  position: absolute;
					  z-index: 1111;
					  right: 0;
					  border: 1px solid #E22222;
					  color: #E22222;
					  border-radius: 50%;
					  cursor: pointer;
					  background-color: #fff;
				}
			</style>
			<button class="button-primary upload_image_button">Upload</button>
			<div class="append-images">
				<?php 
					foreach ($all_images as $url) {
						echo '<div class="img-pup"><span class="dashicons dashicons-no-alt"></span><img class="img-thumbnail " src="'.$url.'" ></div>';
					}
				?>
			</div>
			<div class="clear-fix"></div>
			<hr>
			<button class="button-primary save-settings">Save Settings</button>

			<?php		
					
						}// end meta box

							function custom_function(){
							$option = get_option('nm_image_settings' );	
	
			?>
				<?php settings_errors(); ?>
					<div class="wrap">
					<h2>Your Plugin Name</h2>

					<form method="post" action="options.php">
					    <?php settings_fields( 'image_resizer_group' ); ?>
					    <?php do_settings_sections( 'image_resizer_group' ); ?>
					    <table class="form-table">
					        <tr valign="top">
					        <th scope="row">Change Button Text</th>
					        <td><input type="text" name="nm_image_settings[change_button_text]" value="<?php echo $option['change_button_text']; ?>" /></td>
					        </tr>
					         
					        <tr valign="top">
					        <th scope="row">Enable Author</th>
					        <td><input type='checkbox' name='nm_image_settings[enable_author]' value= "true" <?php if (  $options['enable_author'] = true) echo 'checked="checked"'; ?>/></td>
													     
					        </tr>
					        <tr valign="top">
					        <th scope="row">Enable date</th>
					        <td><input type='checkbox' name='nm_image_settings[enable_author]' value='true' <?php if (  $options['enable_author'] =true) echo 'checked="checked"'; ?>/></td>
					        </tr>
					        
					       
					    </table>
					    
					    <?php submit_button(); ?>

					</form>
					</div>
			<?php 
		}

	function create_post_type(){
		
		
		register_post_type( 'gallery',
		    array(
		      'labels' => array(
		        'name' => __( 'Pr-Gallery' ),
		        'singular_name' => __( 'Gallery' ),
		        
		      ),
		      'public' => true,
		      'has_archive' => true,
		      'supports' => array('', '', '', 'thumbnail', '', ''),
		      'register_meta_box_cb' => array($this, 'add_events_metaboxes'),
		    )
		  );
	}

		// start wp_qurey working
		function render_short_code(){
			wp_enqueue_style( 'fontawsome' ,  plugin_dir_url( __FILE__ ) .'css/font-awesome.min.css' );
			wp_enqueue_style( 'jgallery-css' ,  plugin_dir_url( __FILE__ ) .'css/jgallery.min.css' );
			wp_enqueue_script( 'team-classie' ,  plugin_dir_url( __FILE__ ) .'js/touchswipe.js',array('jquery'),'1.0',true );
			wp_enqueue_script( 'team-color' ,  plugin_dir_url( __FILE__ ) .'js/tinycolor-0.9.16.min.js',array('jquery'),'1.0',true );
			wp_enqueue_script( 'jgallery-js' ,  plugin_dir_url( __FILE__ ) .'js/jgallery.min.js','1.0',true );
			wp_enqueue_script( 'grid3d' ,  plugin_dir_url( __FILE__ ) .'js/script.js',array('jquery'),'1.0',true );
			$all_images = get_option('pr_save_images' );
?>
	
		<div id="gallery">
		<?php 
			foreach ($all_images as $url) {
				echo '<a href="'.$url.'"><img src="'.$url.'" alt="" /></a>';
			}
		?>
		</div>


		
<?php
		
					
		}
	}
 ?>