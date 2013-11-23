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
                  	<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
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