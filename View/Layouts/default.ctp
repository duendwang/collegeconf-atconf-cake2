<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('College Conference Registration'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('collegeconf');
                echo $this->Html->css('jquery.autocomplete');
                
                echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

                echo $this->Html->script('jquery.min'); // Include jQuery library
                echo $this->Html->script('jquery.autocomplete.min.js');
                
                echo $this->Html->script('sorttable'); // Include sorttable library
                
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
                    <table>
                        <tr>
                            <td><h1><?php if(!empty($user)) echo $this->Html->link(__('College Conference Registration'), array('controller' => 'pages','action' => 'display','home'));
                                            else echo $this->Html->link(__('College Conference Registration'), array('controller' => 'pages', 'action' => 'display','registration')); ?></h1></td>
                            <?php if(!empty($user)) {?>
                            <td align="right" style="text-align:right; font-size:10"><h1><?php
                                echo 'Hello, ';
                                    if(strlen($user['first_name']) > 0) {
                                        echo $user['first_name'], ' ', $user['last_name'];
                                    } else{
                                        echo 'church in ', $user['Locality']['name'];
                                    }
                                    echo '. (', $this->Html->link('logout', '/users/logout'), ', '.
                                    $this->Html->link('help',$link).')';?>
                                </h1>
                            </td>
                            <?php }?>
                        </tr>
                    </table>
                </div>
		<div id="content">

			<?php
                        if ($this->Session->check('Message.flash')) {
                            echo $this->Session->flash(); // the standard messages
                        }
                        // multiple messages
                        if ($messages = $this->Session->read('Message.multiFlash')) {
                            //print_r($messages);
                            //echo 'multiple messages';
                            foreach($messages as $k=>$v) echo $this->Session->flash('multiFlash.'.$k);
                        }
                        ?>
                    
                        <?php //echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content');
                            //echo $content_for_layout; ?>

		</div>
		<?php /**<div id="footer">
			<h4><?php echo $this->Html->link(__('Logout'), 'http://localhost/collegeconference/users/logout'); ?></h4>
		</div>**/?>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>