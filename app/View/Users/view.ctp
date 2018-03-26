<?php $this->start('css') ?>
    <?php echo $this->Html->css('articles') ?>
<?php $this->end(); ?>
<div class="container">
    <section>
        <h2><?= $user['User']['name'] ?></h2>
        <div class="info">
            <span class="comments">
                <span class="glyphicon glyphicon-comment"></span>
                <?= count($user['Comment']) ?> Comments
            </span>
        </div>
        <div class="content">
            <?= $user['User']['description'] ?>
        </div>

    </section>
    <hr>
    <div class="row">
      <div class="col-md-10">
        <section class="articles">
          <?php foreach ($user['Article'] as $key => $value): ?>
            <article>
              <h2><?= $this->Html->link($value['title'], array('controller'=>'articles', 'action'=>'view', $value['id'])) ?></h2>
              <div class="info">
                <span class="date">
                  <span class="glyphicon glyphicon-calendar"></span>
                  <?= $value['modified'] ?>
                </span>
                <span class="user">
                    <?= $this->Html->link($user['User']['name'], array('controller'=>'users', 'action'=>'view', $user['User']['id'])) ?>
                </span>
                <span class="comments">
                  <span class="glyphicon glyphicon-comment"></span>
                  <?= count($value['Comment']) ?> Comments
                </span>
              </div>
              <div class="content">
                <p><?= $value['summary'] ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </section>
      </div>
    </div>

</div>
