<div class="content_area">
    <div class="pic"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/exclusive_digitalmarket/pic.jpg" width="409" height="309" alt=""></div>
    <div class=" form_div">
        <h3>join now for free</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '',
            'action' => Yii::app()->createUrl('/home/landingpage'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'class' => '',
            ),
        ));
        ?>
        <?php echo $form->textField($this->user_signUp, 'email', array('class' => 'txt_input', 'placeholder' => 'Email', 'required' => 'required', 'email' => 'email')); ?>
        <?php echo $form->error($this->user_signUp, 'email'); ?>
        <?php echo $form->textField($this->user_signUp, 'username', array('class' => 'txt_input', 'placeholder' => 'Username', 'required' => 'required')); ?>
        <?php echo $form->error($this->user_signUp, 'username'); ?>
        <?php echo $form->passwordField($this->user_signUp, 'password', array('class' => 'txt_input', 'placeholder' => 'Password', 'required' => 'required')); ?>
        <?php echo $form->error($this->user_signUp, 'username'); ?>
        <input name="" type="submit" class="bt" value="Join  Now" />
        <!--<div><a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/exclusive_digitalmarket/fb.png" width="369" height="20" alt=""></a></div>-->
        <?php $this->endWidget(); ?>
    </div>
    <div class="clear"></div>
</div>