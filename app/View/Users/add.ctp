<?php $this->start('css') ?>
    <?php echo $this->Html->css('signup') ?>
<?php $this->end(); ?>

<div class="signup">
    <h2>Sign up for Bootcamp</h2>
    <?php echo $this->Form->create() ?>
        <?php echo $this->Form->input('name', array('div'=>'form-group', 'class'=>'form-control')) ?>
        <?php echo $this->Form->input('email', array('div'=>'form-group', 'class'=>'form-control')) ?>
        <?php echo $this->Form->input('password', array('div'=>'form-group', 'class'=>'form-control')) ?>
        <?php echo $this->Form->submit('Create an account', array('class'=>'btn btn-primary btn-lg')) ?>
    <?php echo $this->Form->end() ?>
</div>
