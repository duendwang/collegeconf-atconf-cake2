<div class="content">
    <style>
        table {
            margin-bottom: 0px;
	}
        table tr td {
            border-bottom:0px;
        }
        table.white tr:nth-child(even) {
            background: #ffffff;
        }
    </style>
        <h2><?php echo __('Badges'); ?></h2>
	<h4 style="font-size: 130%; margin-left:3em"><?php echo __('Waiting Attendees:');?></h4>
        <table cellpadding="0" cellspacing="0" style="margin-left:6em">
            <tr>
			<th><?php echo $this->Paginator->sort('first_name','First Name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
            </tr>
        <?php foreach ($attendees as $attendee): ?>
            <tr>
                <td>
			<?php echo $this->Html->link($attendee['Attendee']['first_name'], array('action' => 'badges', $attendee['Attendee']['id'])); ?>
		</td>
                <td>
			<?php echo $this->Html->link($attendee['Attendee']['last_name'], array('action' => 'badges', $attendee['Attendee']['id'])); ?>
		</td>
                <td><?php echo h($attendee['Attendee']['Locality']['city']); ?>&nbsp;</td>
            </tr>
        <?php endforeach;?>
        </table>
        <br>
        <hr>
        <br>

<?php if(isset($current_attendee)) {
    echo $this->Form->create('OnsiteRegistration');?>
        <fieldset>
            <legend><?php echo(__('Badge Printing'));?></legend>
            <table style="margin-left:3em" class="white">
                <tr>
                    <td>
                        <h4 style="font-size:130%;font-weight:bold"><?php echo $this->Form->label($current_attendee['Attendee']['first_name'].' '.$current_attendee['Attendee']['last_name']);
                        echo $this->Form->hidden('id',array('label' => false,'default' => $current_attendee['OnsiteRegistration'][0]['id']));?>
                    </td>
                    <td>
                        <h4 style="font-size:130%;font-weight:bold"><?php echo $this->Form->label($current_attendee['Locality']['city']);?></h4><br>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->submit(__('Badge has been printed'));?></td>
                </tr>
            </table>
        </fieldset>
<?php echo $this->Form->end();
} ?>
<?php /**<?php echo $this->Form->create('OnsiteRegistration'); ?>
	<fieldset>
		<legend><?php echo __('Add Onsite Registration'); ?></legend>
	<?php
		echo $this->Form->input('attendee_id');
		echo $this->Form->input('cashier');
		echo $this->Form->input('hospitality');
		echo $this->Form->input('badge');
		echo $this->Form->input('need_cashier');
		echo $this->Form->input('need_hospitality');
		echo $this->Form->input('need_badge');
		echo $this->Form->input('need_old');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>**/?>
</div>