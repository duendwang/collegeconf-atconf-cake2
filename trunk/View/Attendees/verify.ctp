<div class="content">
    <style>
        table tr td {
            border-bottom:0px;
    </style>

<?php echo $this->Form->create('Attendee');

if(!empty($options)) {?>
    <h2><?php echo __('Possible Matches'); ?></h2>
    <h4 style="font-size:120%; padding-left:3em">We found some possible matches for existing attendees based on what you entered. Is one of these entries you?</h4><br>
    <?php echo $this->Form->radio('Match',$options,array('label' => false,'legend' => false,'style' => "margin: 3px 10px 0px 10em"));?>
    <br><br>
        <table>
            <tr>
                <td width="500" align="center"><?php echo $this->Form->submit(__('Yes. Edit my information.'),array('name' => 'Submit'));?></td>
                <td><?php echo $this->Form->submit(__('No. Register as new attendee.'),array('name' => 'Submit'));?></td>
            </tr>
        </table>
    
<?php } elseif (!empty($attendee)) {?>
    <h2><?php  echo __('Verify Information'); ?></h2>
    <h4 style="font-size:120%; padding-left:3em">Please verify that the information you entered is correct:</h4>
    <table>
        <tr>
            <td width="50px"></td>
            <td>
                <dl>
                    <dt><?php echo __('First Name'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['first_name']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Last Name'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['last_name']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Gender'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['gender']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Cell Phone'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['cell_phone']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Email'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['email']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Locality'); ?></dt>
                    <dd>
			<?php echo h($attendee['Locality']['name']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Status'); ?></dt>
                    <dd>
			<?php echo h($attendee['Status']['name']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Campus'); ?></dt>
                    <dd>
			<?php echo h($attendee['Campus']['name']); ?>
			&nbsp;
                    </dd>
                    <dt><?php echo __('Registration Type'); ?></dt>
                    <dd>
			<?php echo h($attendee['Attendee']['type']); ?>
			&nbsp;
                    </dd>
                    <?php if($attendee['Attendee']['type'] === 'Part time') {?>
                        <dt><?php echo __('Meetings'); ?></dt>
                        <dd>
                            <?php echo h($attendee['Attendee']['meetings']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Meals'); ?></dt>
                        <dd>
                            <?php echo h($attendee['Attendee']['meals']); ?>
                            &nbsp;
                        </dd>
                        <dt><?php echo __('Outline Booklet Needed'); ?></dt>
                        <dd>
                            <?php echo h($attendee['Attendee']['booklet']); ?>
                            &nbsp;
                        </dd>
                    <?php } ?>
                </dl>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="500" align="center"><?php echo $this->Form->submit(__('Confirm'),array('name' => 'Submit'));?></td>
            <td><?php //echo $this->Form->submit(__('Edit my information.'),array('name' => 'Submit'));?></td>
        </tr>
    </table>

<?php } elseif (!empty($confirm)) {?>
    <h2>Thank you for your registration!</h2>
    <?php if($confirm['table'] !== '4') echo '<h3 style="font-size: 130%; padding-left:3em">Please see a serving one for your temporary name badge and to make sure nothing else is needed from you at this station.</h3>';
    else echo '<h3 style="font-size: 130%; padding-left:3em">Please see a serving one to make sure nothing else is needed from you at this station.</h3>'; ?>
    <br><br>
    
    <h3 style="text-align:center">Based on your selections, your cost for this conference is <span style="color: #FF0099">$<?php echo h($confirm['cost']);?></span>.</h3><br>
    <?php if($confirm['table'] !== '0') :?><h3 style="text-align:center">Please go to the <span style="color: #FF0099"><?php echo h($confirm['table']);?> station</span> to continue your registration.</h3><?php endif; ?><br>
<?php echo $this->Form->submit(__('OK'),array('name' => 'Submit'));
}
$this->Form->end();?>
</div>
