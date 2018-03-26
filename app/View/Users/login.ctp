<?php $this->start('css') ?>
    <?php echo $this->Html->css('cover') ?>
<?php $this->end(); ?>
<div class="cover">
    <div class="login">
        <h2>Log in</h2>
        <?php echo $this->Form->create() ?>
            <?php echo $this->Form->input('email', array('div'=>'form-group', 'class'=>'form-control')) ?>
            <?php echo $this->Form->input('password', array('div'=>'form-group', 'class'=>'form-control')) ?>
            <div class="form-group">
                <?php echo $this->Form->submit('Log in', array('class'=>'btn btn-default', 'div'=>false)) ?>
                <?php echo $this->Html->link('Sign up for Bootcamp', array('controller'=>'users', 'action'=>'add'), array('class'=>'btn btn-link')) ?>
            </div>
        <?php echo $this->Form->end() ?>
    </div>
</div>
