<?php
/**
	* Extends WP_Customize_Control and adds multipel custom option fields to be used within Theme Customizer.
 	*
 	* @category   Customize
 	* @package    Soren
 	* @author     Nick Haskins <email@nickhaskins.com>
 	* @copyright  2013 Nick Haskins
 	* @license    http://www.gnu.org/licenses/gpl-2.0.html  GNU General Public License v2 or later
 	* @version    Release: 1.0
 	*
*/

if (class_exists('WP_Customize_Control')){

    class Soren_WP_Customize_Textarea_Control extends WP_Customize_Control {
    	public $type = 'textarea';

    	public function render_content() {
    		?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<textarea style="width: 100%;" rows="5" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
    		</label>
    		<?php
    	}
    }

}

if (class_exists('WP_Customize_Control')){
    class Soren_Category_Dropdown_control extends WP_Customize_Control{
        public function render_content() {

            ?>
                <label>
                  	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  	<select <?php $this->link(); ?>>
                       	<?php
                            $args = array();
                            $cats = get_categories($args);
                            foreach ( $cats as $cat ) {
                                echo '<option value="'.$cat->term_id.'"'.selected($this->value(), $cat->term_id).'>'.$cat->name.'</option>';
                            }
                       	?>
                  </select>
                </label>
            <?php
        }
    }
}

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Google_Font_Dropdown_Control extends WP_Customize_Control{
    private $fonts = false;

    public function __construct($manager, $id, $args = array(), $options = array()){
        $this->fonts = $this->get_fonts();
        parent::__construct( $manager, $id, $args );
    }

    public function render_content(){
        if(!empty($this->fonts)){
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                        <?php
                            foreach ( $this->fonts as $k => $v ){
                                printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v->family);
                            }
                        ?>
                    </select>
                </label>
            <?php
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $amount = 100 ){

        $selectDirectory = SOREN_THEME_DIR.'/fonts/gfonts/';

        $finalselectDirectory = '';

        if(is_dir($selectDirectory)){
            $finalselectDirectory = $selectDirectory;
        }

        $fontFile = $finalselectDirectory . '/google-web-fonts.txt';

        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;

        if(file_exists($fontFile) && $cachetime < filemtime($fontFile)){
            $content = json_decode(file_get_contents($fontFile));
        } else {

            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key={API_KEY}';

            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

            $fp = fopen($fontFile, 'w');
            fwrite($fp, $fontContent['body']);
            fclose($fp);

            $content = json_decode($fontContent['body']);
        }

        if($amount == 'all'){
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
}
?>