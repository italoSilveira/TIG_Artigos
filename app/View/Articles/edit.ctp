<?php $this->start('css') ?>
    <?php echo $this->Html->css('articles') ?>
<?php $this->end(); ?>
<?php $this->start('script') ?>
    <?php echo $this->Html->script('articles') ?>
<?php $this->end(); ?>

<div class="container">

  <ol class="breadcrumb">
    <li><a href="/articles/">Articles</a></li>
    <li class="active">Write Article</li>
  </ol>
  <?php echo $this->Form->create() ?>
    <?php echo $this->Form->input('id') ?>
    <?php echo $this->Form->input('title', array('div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control')) ?>
    <?php echo $this->Form->input('summary', array('div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control')) ?>
    <?php echo $this->Form->input('content', array('div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control editor')) ?>
    <?php echo $this->Form->input('Category', array('multiple'=>true, 'div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control', 'options'=>$categories)) ?>
    <?php echo $this->Form->input('KeyWord', array('multiple'=>true, 'div'=>'form-group', 'label'=>array('class'=>'control-label'), 'class'=>'form-control', 'options'=>$keyWords)) ?>
    <div class="form-group">
      <?php echo $this->Form->submit('Salvar', array('class'=>'btn btn-primary', 'div'=>false)) ?>
    </div>
  <?php echo $this->Form->end() ?>
</div>
