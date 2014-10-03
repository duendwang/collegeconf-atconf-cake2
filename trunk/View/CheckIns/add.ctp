<?php $barcodeLength = 7;?>

<div class="content">
<?php echo $this->Form->create('CheckIn');?>
    <fieldset>
        <legend><?php echo __('Check In Attendee'); ?></legend>
            <?php echo $this->Form->input('barcode'); ?>
            <span id="submittingText"></span>
	</fieldset>
    <?php echo $this->Form->end(__('Check In'));?>
</div>
<?php   
        echo $this->Html->scriptBlock('
            /*var barcodetext = \'\';
            $(window).keypress(function(e){
                var intKey = (window.Event) ? e.which : e.keyCode;//fix for firefox
                barcodetext += String.fromCharCode(intKey);
                $(\'input[name="data[CheckIn][barcode]"]\').val(barcodetext);
                if (barcodetext.length == '.$barcodeLength.')
                { 
                    //alert(barcodetext);
                    $("form").submit();
                    $(\'input[name="data[CheckIn][barcode]"]\').val(\'\');
                    barcodetext = \'\';
                }
            });*/
            $(\'input[name="data[CheckIn][barcode]"]\').focus().keyup(function() {
                if(this.value.length >= '.$barcodeLength.') {
                    this.readOnly = true;
                    this.value = this.value.substring(0, '.$barcodeLength.');
                    this.form.submit();
                    $("#submittingText").html("Submitting...");
                }
            });
');
        
        //$this->Js->event('keypress', '$(\'input[name="data[Attendee][id]"]\').val(\'\');')
        echo $this->Js->writeBuffer();
?>
