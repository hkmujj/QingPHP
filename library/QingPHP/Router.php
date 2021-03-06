<?php
/**
 * QingPHP_Router 路由 
 * 
 * @uses QingPHP_Route_Interface
 * @final
 * @package package
 * @version $Id$
 * @copyright ©2013
 * @author chen1706 <chen1706@gmail.com> 
 * @license New BSD License
 */
final class QingPHP_Router implements QingPHP_Route_Interface
{
	protected $rules = array();
    private static $instance = null;

    /**
     * __construct 
     * 
     * @access private
     * @return void
     */
	private function __construct()
    {
        $config = QingPHP::getApplication()->config();        
        $this->defaultController = $config['default_c'];
        $this->defaultAction     = $config['default_a'];
    }

    /**
     * instance 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function instance()
    {
        if (!isset(self::$instance) || self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * route 路由 
     * 
     * @param QingPHP_Request_Abstract $request 
     * @access public
     * @return void
     */
    public function route(QingPHP_Request_Abstract $request)
    {
        $action     = $request->get('a') ?: $this->defaultAction;
        $controller = $request->get('c') ?: $this->defaultController;
        return array('controller' => ucfirst(strtolower($controller)), 'action' => strtolower($action));
    }
}
