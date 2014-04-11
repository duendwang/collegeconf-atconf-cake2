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
	<h2><?php echo 'Attendee On-site Registration'; ?></h2>
        <?php echo $this->Form->input('conference_id', array('hidden' => true,'label' => false,'div' => false));
        //echo $this->Form->hidden('rate', array('label' => false));?>
        
        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Please fill out the form completely. All fields are required. You will only be contacted for conference-related matters.</h4><br>
        <fieldset>
            <legend><?php echo __('Personal');?><hr width="500"></legend>
            <h4 style="margin-left:3em">If you have already registered for this conference, fill out only your <span style="font-weight:bold">first and last name and cell phone number</span> below, and click Submit.</h4>
            <table>
                <tr>
			<td width=50></td>
			<td><?php echo $this->Form->input('first_name');?></td>
			<td><?php echo $this->Form->input('last_name');?></td>
			<td><?php echo $this->Form->input('gender', array('type' => 'select', 'empty' => true, 'options' => array('B' => 'Male','S' => 'Female')));?></td>
		</tr>
		<tr>
			<td width=50></td>
			<td><?php echo $this->Form->input('cell_phone',array('label' => 'Cell Phone (xxx-xxx-xxxx)'));?></td>
			<td><?php echo $this->Form->input('email');?></td>
			<?php /**<td><?php echo $this->Form->input('city_state', array('label' => 'City, State of Residence'));?></td>**/?>
		</tr>
		<tr>
			<td width=50></td>
			<td><?php echo $this->Form->input('status_id', array('label' => 'Current Status','empty' => true, 'default' => null));?></td>
			<td colspan="2"><?php echo $this->Form->input('campus_id', array('label' => 'College Campus','empty' => true));?></td>
		</tr>
		<tr>
			<td width=50></td>
			<td>
                            <?php echo $this->Form->input('locality_id',array('empty' => true,'default' => null));?>
                        </td>
                        <td>
                            <?php echo '<br>This is not the city in which you reside. If you are unsure what to enter here, please consult with a serving one.'?>
                        </td>
		</tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><?php echo __('Registration Type');?><hr width="500"></legend>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Please indicate the length and type of registration:<br><br>
            <table>
		<tr>
			<td width=50></td>
			<td colspan=3>
                            <?php echo $this->Form->radio('reg_type',array('ft_lodging' => '&nbsp; Full time, lodging arrangement needed','ft_nolodging' => '&nbsp; Full time, will make separate lodging arrangements.',/**'sat_only' => '&nbsp; Saturday only',**/'pt' => '&nbsp; Other (please indicate):'), array('legend' => false));?>
                        </td>
                </tr>
                <tr>
                    <td></td>
                    <td width=50></td>
                    <td><h3>Meetings:</h3>1-2 message meetings are at no cost. 3 message meetings $65, 4 $75.</td>
                    <td><h3>Meals:</h3>$10 each if attending 2 message meetings or less, included otherwise.</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="padding-left: 5em">
                        <?php echo $this->Form->input('pt_meetings',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('fri' => 'Friday night','satm' => 'Saturday morning','sata' => 'Saturday afternoon (free)','satn' => 'Saturday night','ld' => 'Sunday morning'),'style' => "margin: 3px 10px 0px 0px; display: inline"));
                        /**echo $this->Form->input('pt_meetings',array('type' => 'checkbox','value' => 'fri','label' => 'Friday night','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        //echo $this->Form->label('pt_meetings_fri','Friday night',array('div' => false, 'style' => "display: inline"));
                        echo $this->Form->input('pt_meetings',array('type' => 'checkbox','value' => 'satm', 'label' => 'Saturday morning','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meetings',array('type' => 'checkbox','value' => 'sata', 'label' => 'Saturday afternoon','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meetings',array('type' => 'checkbox','value' => 'satn', 'label' => 'Saturday night','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meetings',array('type' => 'checkbox','value' => 'ld', 'label' => 'Sunday morning','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));**/?>
                    </td>
                    <td style="padding-left: 5em">
                        <?php echo $this->Form->input('pt_meals',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('fri' => 'Friday dinner','satl' => 'Saturday lunch','satd' => 'Saturday dinner','ld' => 'Sunday lunch'),'style' => "margin: 3px 10px 0px 0px; display: inline"));
                        /**echo $this->Form->input('pt_meals',array('type' => 'checkbox','value' => 'fri', 'label' => 'Friday dinner','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meals',array('type' => 'checkbox','value' => 'satl', 'label' => 'Saturday lunch','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meals',array('type' => 'checkbox','value' => 'satd', 'label' => 'Saturday dinner','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_meals',array('type' => 'checkbox','value' => 'ld', 'label' => 'Sunday lunch','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));**/?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Miscellaneous:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="padding-left: 5em">
                        <?php echo $this->Form->input('pt_misc',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('book' => 'Outline booklet ($5)'),'style' => "margin: 3px 10px 0px 0px; display: inline"));
                        /**echo $this->Form->input('pt_misc',array('type' => 'checkbox','value' => 'book', 'label' => 'Outline booklet','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));
                        echo $this->Form->input('pt_misc',array('type' => 'checkbox','value' => 'water', 'label' => 'Water bottle','div' => false,'style' => 'margin: 3px 10px 0px 0px; display: inline'));**/?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <table>
            <tr>
                <td width="250" align="center"><?php echo $this->Form->submit(__('Submit'),array('name' => 'submit'));?></td>
                <td style="padding-top: 27px"><?php echo $this->Form->submit(__('Cancel'),array('name' => 'cancel','style' => "display:inline", 'div' => false));?></td>
            </tr>
        </table>
<?php echo $this->Form->end(); ?>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>

		<li><?php /**echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?></li>
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
</div>-->
<?php /**
<script>
$(document).ready(function(){  
    $("AttendeeCampusId").autocomplete("/Attendees/find.json", {
    minChars: 3
    });
  });
</script>
 **/?>