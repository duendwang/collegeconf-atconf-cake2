<div class="content">
    <style>
        table {
            margin-bottom: 0px;
	}
        table tr td {
            border-bottom:0px;
        }
        table tr:nth-child(even) {
            background: #ffffff;
        }
    </style>
<?php echo $this->Form->create('Attendee'); ?>
<h2>Edit Attendee</h2>
<h2 style="text-align: center; color:#333"><?php echo $this->request->data['Attendee']['first_name'],' ',$this->request->data['Attendee']['last_name'];?></h2>
<?php echo $this->Form->input('id');
echo $this->Form->input('reg_type',array('label' => false,'hidden' => true,'div' => false));?>
<fieldset>
    <legend><?php echo __('Personal');?><hr width="500"></legend>
    <table>
        <tr>
            <td width=100></td>
            <td><?php echo $this->Form->input('first_name');?></td>
            <td><?php echo $this->Form->input('last_name');?></td>
            <td><?php echo $this->Form->input('gender', array('type' => 'select', 'empty' => true, 'options' => array('B' => 'Brother','S' => 'Sister')));?></td>
        </tr>
        <tr>
            <td width=100></td>
            <td><?php echo $this->Form->input('cell_phone',array('label' => 'Cell Phone (XXX-XXX-XXXX)'));?></td>
            <td><?php echo $this->Form->input('email');?></td>
            <?php /**<td><?php echo $this->Form->input('city_state', array('label' => 'City, State of Residence'));?></td>**/?>
        </tr>
        <tr>
            <td width=100></td>
            <td><?php echo $this->Form->input('status_id', array('label' => 'Current Status','empty' => true, 'default' => null));?></td>
            <td colspan="2"><?php echo $this->Form->input('campus_id', array('empty' => true, 'default' => null));?></td>
        </tr>
        <tr>
            <td width="100"></td>
            <td colspan="3">
                <?php echo '&nbsp;Is this attendee a:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $this->Form->input('new_one', array('label' => false, 'div' => false, 'style' => 'float: none')),
                        'new one?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $this->Form->input('conf_contact', array('label' => false, 'div' => false, 'style' => 'float: none')),
                        'conference contact?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $this->Form->input('nurse', array('label' => false, 'type' => 'checkbox','div' => false, 'style' => 'float: none')),
                        'conference-designated nurse? <br><br>';?>
            </td>
        </tr>
        <tr>
            <td width=100></td>
            <td colspan="3"><?php echo $this->Form->input('comment');?></td>
        </tr>
    </table>
</fieldset>
<fieldset>
    <legend><?php echo __('Hospitality');?><hr width="500"></legend>
    <table>
        <tr>
            <td width=100></td>
            <td><?php echo $this->Form->input('lodging_id',array('empty' => true));?></td>
	</tr>
    </table>
</fieldset>
<fieldset>
    <legend><?php echo __('Payment');?><hr width="500"></legend>
        <table>
            <tr>
                <td width=100></td>
		<td><?php echo $this->Form->input('rate');?></td>
		<td><?php echo $this->Form->input('paid_at_conf');?></td>
            </tr>
        </table>
</fieldset>

<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php /**echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Attendee.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Attendee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); **/?> </li>
	</ul>
</div>
-->