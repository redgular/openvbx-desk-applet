

<div class="vbx-applet calllogger-applet">
    <h2>This applet creates a case in Desk for calls</h2>
    <p>Enter in the URL subdomain you use for Desk</p>
    <textarea class="medium" name="prompt-text"><?php 
        echo AppletInstance::getValue('prompt-text') 
    ?></textarea>
 <br />
    <h2> Select An Action for The Caller</h2>
    <?php echo AppletUI::DropZone('primary'); ?>
</div>

