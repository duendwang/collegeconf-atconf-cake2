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
    <h2><?php echo 'Add Conference Attendee'; ?></h2>
    <br>
    <center>
        <?php echo 'Is this attendee a:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            $this->Form->input('new_one', array('label' => false, 'div' => false, 'style' => 'float: none')),
            'new one?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            $this->Form->input('conf_contact', array('label' => false, 'div' => false, 'style' => 'float: none')),
            'conference contact?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            $this->Form->input('nurse', array('label' => false, 'type' => 'checkbox','div' => false, 'style' => 'float: none')),
            'conference-designated nurse? <br><br>';?>
    </center>
    <?php echo $this->Form->input('conference_id', array('hidden' => true,'label' => false, 'div' => false, 'style' => 'float: none'));?>
    
    <fieldset>
        <legend><?php echo __('Personal');?><hr width="500"></legend>
        <table>
            <tr>
                <td width=25></td>
		<td><?php echo $this->Form->input('first_name');?></td>
		<td><?php echo $this->Form->input('last_name');?></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><?php echo $this->Form->input('campus_id', array('empty' => true, 'default' => null));?></td>
            </tr>
            <tr>
                <td></td>
		<td><?php echo $this->Form->input('cell_phone',array('label' => 'Cell Phone'));?></td>
		<td><?php echo $this->Form->input('email');?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo $this->Form->input('gender', array('type' => 'select', 'empty' => true, 'options' => array('B' => 'Brother','S' => 'Sister'),'default' => null));?></td>
		<td><?php echo $this->Form->input('status_id', array('label' => 'Current Status','empty' => true, 'default' => null));?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo $this->Form->input('locality_id',array('empty' => true,'default' => null));?></td>
                <td><?php echo $this->Form->input('paid_at_conf',array('label' => 'Amount Paid'));?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo $this->Form->input('CheckIn.timestamp',array('label' => 'Check in Time'));?></td>
            </tr>
            <tr>
                <td></td>
		<td colspan="3"><?php echo $this->Form->input('comment');?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Registration Type');?><hr width="500"></legend>
        <table>
            <tr>
                <td width=25></td>
                <td colspan=3>
                    <?php echo $this->Form->radio('reg_type',array(
                        'ft_lodging' => 'Full time with lodging (fill out lodging below)',
                        'ft_nolodging' => 'Full time, no lodging',
                        'sat_only' => 'Saturday only (3 meetings, 2 meals, booklet, water bottle)',
                        'pt' => 'Other:'
                    ),
                    array('legend' => false,'style' => "margin: 4px 15px 0px 0px"));?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td width=50></td>
                <td><h3>Meetings:</h3></td>
                <td><h3>Meals:</h3></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-left: 2em">
                    <?php echo $this->Form->input('pt_meetings',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('fri_mtg' => 'Friday night','sat_mtg1' => 'Saturday morning','sat_mtg2' => 'Saturday afternoon','sat_mtg3' => 'Saturday night','ld_mtg' => 'LD morning'),'style' => "margin: 3px 10px 0px 0px; display: inline"));?>
                </td>
                <td style="padding-left: 2em">
                    <?php echo $this->Form->input('pt_meals',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('fri_din' => 'Friday dinner','sat_bkfst' => 'Saturday breakfast','sat_lun' => 'Saturday lunch','sat_din' => 'Saturday dinner','ld_bkfst' => 'LD breakfast','ld_lun' => 'LD lunch'),'style' => "margin: 3px 10px 0px 0px; display: inline"));?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><h3>Miscellaneous:</h3></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-left: 2em">
                    <?php echo $this->Form->input('pt_misc',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('booklet' => 'Outline booklet','water' => 'Water bottle'),'style' => "margin: 3px 10px 0px 0px; display: inline"));?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><?php echo $this->Form->input('rate',array('label' => 'Rate (only if different from standard calculated)'));?></td>
                <td><?php echo $this->Form->input('lodging_id',array('label' => '&emsp;&emsp;&emsp; Lodging','empty' => true,'default' => null,'style' => "margin-left: 3em"));?></td>
            </tr>
        </table>
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>