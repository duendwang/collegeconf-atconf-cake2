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
<?php echo $this->Form->create('PotentialAttendee'); ?>
	<h2><?php echo 'Register for college conference'; ?></h2>
        <p style="margin-left:2em">Please fill out the form completely. All fields are required unless they do not apply.<br><br>
        <u>Please note that this is for full-time registrants only.</u> If you can only go part time to the conference, please talk to your local registration coordinator or to whoever invited you to the conference.</p>
        
        <?php echo $this->Form->input('locality_id', array('label' => false,'hidden' => true, 'default' => $locality));
            echo $this->Form->input('conference_id', array('label' => false,'hidden' => true, 'default' => $conference));?>
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
			<td colspan="2"><?php echo $this->Form->input('campus_id', array('empty' => true));?></td>
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
			<td><?php echo $this->Form->input('allergies',array('type' => 'select', 'empty' => true, 'options' => array('C' => 'Cats','D' => 'Dogs','O' => 'Other','CD' => 'Cats + Dogs','CO' => 'Cats + Other','DO' => 'Dogs + Other','CDO' => 'Cats, Dogs, and Other')));?></td>
			<td><?php echo $this->Form->input('other_allergies', array('label' => 'If other, please indicate:'));?></td>
                </tr>
<?php /** Uncomment for Anaheim
                <tr>
                    <td colspan="3">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Please fill out for any prearranged hospitality.</td>
                </tr>
                <tr>
                    <td width=100></td>
                    <td><?php echo $this->Form->input('host_name');?></td>
                    <td><?php echo $this->Form->input('host_address');?></td>
                    <td><?php echo $this->Form->input('host_phone');?></td>
		</tr>
**/?>
            </table>
        </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>