<div class="users form">
    <style>
        body {
            background: #003d4c;
        }
        #content {
            overflow: auto;
        }
    </style>
<?php //echo $this->Session->flash('auth'); ?>
    <?php //print_r($this->Auth->User);?>
<?php echo $this->Form->create('User');?>
    <h3 style="color:red">Warning: This system is intended for Local Registration Coordinator use only. If you are not a Local Registration Coordinator, please exit this page and register through your Local Registration Coordinator, or through the individual who invited you to this conference.</h3>
    <br><br>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('On-site Registration'), array('controller' => 'pages', 'action' => 'display','registration')); ?></li>
  </ul>
</div>