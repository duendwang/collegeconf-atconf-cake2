<?php $barcodeLength = 7;?>

<div class="content">
    <?php echo $this->Form->create('Cancel');?>
    <fieldset>
        <?php if (!empty($attendee)) { ?>
            <legend><?php echo __('Cancel '.$attendee['Attendee']['name']); ?></legend>
            <?php echo $this->Form->hidden('barcode',array('default' => $attendee['Conference']['code'].$attendee['Attendee']['id']));
            echo $this->Form->hidden('Referer.url',array('default' => $referer));?>
        <?php } else { ?>
            <legend><?php echo __('Cancel Attendee'); ?></legend>
            <?php echo '<h3>If you need to scan a barcode, you may scan the barcode when you get to the Barcode field.</h3>';
            echo $this->Form->input('barcode');
        }   
        echo $this->Form->input('conference_id',array('hidden' => true,'label' => false,'div' => false));
        echo $this->Form->input('reason');
        echo $this->Form->input('replaced',array('label' => 'Replaced By'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php /**  
        echo $this->Html->scriptBlock('
            var barcodetext = \'\';
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
            });');
        
        //$this->Js->event('keypress', '$(\'input[name="data[Attendee][id]"]\').val(\'\');')
        echo $this->Js->writeBuffer();
**/ ?>
