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
        <h2><?php echo __('Cashier'); ?></h2>
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
			<?php echo $this->Html->link($attendee['Attendee']['first_name'], array('action' => 'cashier', $attendee['Attendee']['id'])); ?>
		</td>
                <td>
			<?php echo $this->Html->link($attendee['Attendee']['last_name'], array('action' => 'cashier', $attendee['Attendee']['id'])); ?>
		</td>
                <td><?php echo h($attendee['Attendee']['Locality']['city']); ?>&nbsp;</td>
            </tr>
        <?php endforeach;?>
        </table>
        <br>
<?php echo $this->Form->create('OnsiteRegistration'); ?>
        <fieldset>
            <h4 style="font-size: 130%; margin-left:3em"><?php echo __('Localities:'); ?></h4>
            <span style="margin-left:6em"><?php echo $this->Form->select('locality_id',$localities,array('label' => false));?></span>
        </fieldset>
            <?php echo $this->Form->end(array('label' => __('Submit'),'style' => "margin-left:4em"));?>
        <br>
        <hr>
        <br>
        
<?php if(isset($locality)) {
    echo $this->Form->create('Payment');?>
        <fieldset>
            <legend><?php echo(__('Locality Payment'));?></legend>
            <table style="margin-left:3em" class="white">
                <tr>
                    <td colspan="4" style="text-align: center">
                        <h4 style="font-size:130%;font-weight:bold"><?php echo $this->Form->label($locality[0]['Locality']['city']);
                        echo $this->Form->hidden('locality_id',array('label' => false,'default' => $locality[0]['Locality']['id']));
                        echo $this->Form->hidden('timestamp',array('label' => false));?></h4>
                    </td>
                </tr>
                <tr>
                    <td width ="25"></td>
                    <td><?php echo $this->Form->input('cash',array('type' => 'text','label' => 'Paid by cash:'));?></td>
                    <td><?php echo $this->Form->input('check_number',array('type' => 'text','label' => 'Check #:'));?></td>
                    <td><?php echo $this->Form->input('check',array('type' => 'text','label' => 'Paid by check:'));?></td>
                </tr>
                <tr>
                    <td width="25"></td>
                    <td colspan="2"><?php echo $this->Form->input('comment',array('type' => 'textbox'));?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->submit(__('Submit'));?></td>
                </tr>
            </table>
        </fieldset>
<?php echo $this->Form->end();
} ?>

<?php if(isset($current_attendee)) {
    echo $this->Form->create('Payment');?>
        <fieldset>
            <legend><?php echo(__('Attendee Payment'));?></legend>
            <table style="margin-left:3em" class="white">
                <tr>
                    <td></td>
                    <td colspan="2" style="text-align: center">
                        <h4 style="font-size:130%;font-weight:bold"><?php echo $this->Form->label($current_attendee['Attendee']['first_name'].' '.$current_attendee['Attendee']['last_name']);
                        echo $this->Form->hidden('attendee_id',array('label' => false,'default' => $current_attendee['Attendee']['id']));
                        echo $this->Form->hidden('first_name',array('label' => false,'default' => $current_attendee['Attendee']['first_name']));
                        echo $this->Form->hidden('last_name',array('label' => false,'default' => $current_attendee['Attendee']['last_name']));
                        echo $this->Form->hidden('rate',array('label' => false,'default' => $current_attendee['Attendee']['rate']));
                        echo $this->Form->hidden('amount_due',array('label' => false,'default' => $amount_due));
                        echo $this->Form->hidden('locality_id',array('label' => false,'default' => $current_attendee['Attendee']['locality_id']));
                        echo $this->Form->hidden('timestamp',array('label' => false));?></h4>
                    </td>
                    <td colspan="2" style="text-align: center">
                        <h4 style="font-size:130%;font-weight:bold"><?php echo $this->Form->label($current_attendee['Locality']['city']);?></h4><br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4" style="text-align: center">
                        <h3>Amount due: <span style="color: #FF0099"><?php echo $amount_due;?></span></h3>
                    </td>
                </tr>
                <tr>
                    <td width ="25"></td>
                    <td><?php echo $this->Form->input('cash',array('type' => 'text','label' => 'Paid by cash:'));?></td>
                    <td><?php echo $this->Form->input('check_number',array('type' => 'text','label' => 'Check #:'));?></td>
                    <td><?php echo $this->Form->input('check',array('type' => 'text','label' => 'Paid by check:'));?></td>
                    <td><?php echo $this->Form->input('locality',array('type' => 'text','label' => 'Locality will pay:'));?></td>
                </tr>
                <tr>
                    <td width="50"></td>
                    <td colspan="2"><?php echo $this->Form->input('comment',array('type' => 'textbox'));?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->submit(__('Submit'));?></td>
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
