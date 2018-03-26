
<div class="container">
    <div class="page-header">
        <h1>Account Settings</h1>
    </div>
    <div class="row" style="margin-top: 2em">
        <div class="col-md-12">
            <h3 style="margin-top: 0">Edit Profile</h3>
            <?= $this->Form->create() ?>
                <?php echo $this->Form->input('name', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('email', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('description', array('div'=>'form-group', 'class'=>'form-control editor')) ?>
                <?php echo $this->Form->input('facebook', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('instagram', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('linkedin', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('twitter', array('div'=>'form-group', 'class'=>'form-control')) ?>
                <?php echo $this->Form->input('Category', array('multiple'=>true, 'div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control', 'options'=>$categories)) ?>
                <?php echo $this->Form->input('KeyWord', array('multiple'=>true, 'div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control', 'options'=>$keyWords)) ?>
                <?php echo $this->Form->submit('Salvar', array('div'=>'form-group', 'class'=>'btn btn-primary')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>

</div>
