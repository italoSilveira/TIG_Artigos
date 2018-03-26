<?php $this->start('css') ?>
    <?php echo $this->Html->css('articles') ?>
<?php $this->end(); ?>
<?php $this->start('script') ?>
    <?php echo $this->Html->script('articles') ?>
<?php $this->end(); ?>

<div class="container">

  <div class="page-header">
    <?= $this->Html->link(
        '<span class="glyphicon glyphicon-pencil"></span> Write Article',
        array('controller'=>'articles', 'action'=>'add'),
        array('class'=>'btn btn-primary pull-right', 'escape'=>false)
    ) ?>
    <h1>Articles</h1>
  </div>
  <div class="row">
    <div class="col-md-10">
      <section class="articles">
        <?php foreach ($articles as $key => $value): ?>
          <article>
            <h2><?= $this->Html->link($value['Article']['title'], array('controller'=>'articles', 'action'=>'view', $value['Article']['id'])) ?></h2>
            <div class="info">
              <span class="date">
                <span class="glyphicon glyphicon-calendar"></span>
                <?= $value['Article']['modified'] ?>
              </span>
              <span class="user">
                  <?= $this->Html->link($value['User']['name'], array('controller'=>'users', 'action'=>'view', $value['User']['id'])) ?>
              </span>
              <span class="comments">
                <span class="glyphicon glyphicon-comment"></span>
                <?= count($value['Comment']) ?> Comments
              </span>
              <?php if (!empty($value['Viewed'])): ?>
                  <span class="glyphicon glyphicon-ok"></span>
              <?php endif; ?>
            </div>
            <div class="info">
                <?php if (!empty($value['Category'])): ?>
                    <?php foreach ($value['Category'] as $k => $val): ?>
                        <span class="label label-danger"><?php echo $val['name'] ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($value['KeyWord'])): ?>
                    <?php foreach ($value['KeyWord'] as $k => $val): ?>
                        <span class="label label-default"><?php echo $val['name'] ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="content">
              <p><?= $value['Article']['summary'] ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </section>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-md-12">
      <ul class="pagination">
        <li class="disabled"><span>«</span></li>
        <li class="active"><span>1 <span class="sr-only">(current)</span></span></li>
        <li><a href="?page=2">2</a></li>
        <li><a href="?page=3">3</a></li>
        <li><a href="?page=4">4</a></li>
        <li><a href="?page=2">»</a></li>
      </ul>
    </div>
  </div> -->
</div>
