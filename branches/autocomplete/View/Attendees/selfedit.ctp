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
	<h2><?php echo 'Edit Attendee Registration'; ?></h2>
        <?php echo $this->Form->hidden('rate', array('label' => false));?>
        
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
			<td colspan="2"><?php echo $this->Form->input('campus_id', array('type' => 'text','label' => 'College Campus'));?></td>
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
                            <?php echo $this->Form->radio('reg_type',array('ft' => '&nbsp; Full time',/**'sat_only' => '&nbsp; Saturday only',**/'pt' => '&nbsp; Other (indicate below):'), array('legend' => false));?>
                        </td>
                </tr>
                <tr>
                    <td></td>
                    <td width=50></td>
                    <td>Meetings:</td>
                    <td>Meals:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="padding-left: 5em">
                        <?php echo $this->Form->input('pt_meetings',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('fri' => 'Friday night','satm' => 'Saturday morning','sata' => 'Saturday afternoon','satn' => 'Saturday night','ld' => 'Sunday morning'),'style' => "margin: 3px 10px 0px 0px; display: inline"));
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
                        <?php echo $this->Form->input('pt_misc',array('type' => 'select','label' => false,'multiple' => 'checkbox','options' => array('book' => 'Outline booklet'),'style' => "margin: 3px 10px 0px 0px; display: inline"));
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
<script>
$(document).ready(function(){  
    $("#AttendeeCampusId").autocomplete({
        source: "../../campuses/autocomplete",
        minLength: 2,
        focus: function(event, ui) {
            event.preventDefault();
            $("#AttendeeCampusId").val(ui.item.label);
            return false
        },
        select: function(event, ui) {
            event.preventDefault();
            $("#AttendeeCampusId").val(ui.item.label);
        }
    });
});
</script>