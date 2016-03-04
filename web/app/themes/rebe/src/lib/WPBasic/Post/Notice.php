<?php namespace WPBasic\Post;

/**
 * Cuztom notice class, to easily handle admin notices
 *
 * @link https://github.com/gizburdt/cuztom/blob/master/classes/notice.class.php
 * @author  Gijs Jorissen
 * @since  	2.3
 */
class Notice
{
    public $notice;
    public $type;
    /**
     * Constructor
     *
     * @param  	string 	$notice
     * @param 	string 	$type
     *
     * @author  Gijs Jorissen
     * @since   2.3
     *
     */
    public function __construct($notice, $type = 'updated')
    {
        $this->notice    = $notice;
        $this->type    = $type;
        add_action('admin_notices', [&$this, 'add_admin_notice']);
    }
    /**
     * Adds the admin notice
     *
     * @author 	Gijs Jorissen
     * @since   2.3
     *
     */
    public function add_admin_notice()
    {
        echo '<div class="' . $this->type . '">';
        echo '<p>' . $this->notice . '</p>';
        echo '</div>';
    }
}
