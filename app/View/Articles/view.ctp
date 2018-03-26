<?php $this->start('css') ?>
    <?php echo $this->Html->css('articles') ?>
<?php $this->end(); ?>
<?php $this->start('script') ?>
    <?php echo $this->Html->script('articles') ?>
<?php $this->end(); ?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="/articles/">Articles</a></li>
        <li class="active">Article</li>
    </ol>
    <?php if ($this->Session->read('Auth.User.id') == $article['Article']['user_id']): ?>
      <?= $this->Html->link(
          '<span class="glyphicon glyphicon-pencil"></span> Edit Article',
          array('controller'=>'articles', 'action'=>'edit', $article['Article']['id']),
          array('class'=>'btn btn-primary pull-right', 'escape'=>false)
      ) ?>
    <?php endif; ?>
    <article>
        <h2><?= $article['Article']['title'] ?></h2>
        <div class="info">
            <span class="date">
                <span class="glyphicon glyphicon-calendar"></span>
                <?= $article['Article']['modified'] ?>
            </span>
            <span class="user">
                <?= $this->Html->link($article['User']['name'], array('controller'=>'users', 'action'=>'view', $article['User']['id'])) ?>
            </span>
            <span class="comments">
                <span class="glyphicon glyphicon-comment"></span>
                <?= count($article['Comment']) ?> Comments
            </span>
            <?php if ($viewed): ?>
                <span class="glyphicon glyphicon-ok"></span>
            <?php endif; ?>
        </div>
        <div class="info">
            <?php if (!empty($article['Category'])): ?>
                <?php foreach ($article['Category'] as $k => $val): ?>
                    <span class="label label-danger"><?php echo $val['name'] ?></span>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($article['KeyWord'])): ?>
                <?php foreach ($article['KeyWord'] as $k => $val): ?>
                    <span class="label label-default"><?php echo $val['name'] ?></span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="content">
            <?= $article['Article']['content'] ?>
        </div>

    </article>
    <hr>
    <span class="pull-right text-muted" id="comment-helper" style="display: none"><small>Press Ctrl + Enter to post</small></span>
    <h4><span class="comment-count"><?= count($article['Comment']) ?></span> Comments</h4>
    <div class="post-comment clearfix">
        <?= $this->Form->create('Comment', array('url'=>array('action'=>'add'))) ?>
            <?= $this->Form->hidden('article_id', array('value'=>$article['Article']['id'])) ?>
            <?= $this->Form->hidden('article_id', array('value'=>$article['Article']['id'])) ?>
            <?= $this->Form->input('comment', array('div'=>'comment-input clearfix', 'class'=>'form-control', 'label'=>false, 'rows'=>1, 'placeholder'=>'Write a comment...')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="well well-sm" id="comment-list">
        <?php if (!empty($article['Comment'])): ?>
            <?php foreach ($article['Comment'] as $key => $value): ?>
                <div class="comment">
                    <div class="comment-text">
                        <h5>
                            <?= $this->Html->link($value['User']['name'], array('controller'=>'users', 'action'=>'view', $value['User']['id'])) ?>
                            <small><?= $value['created'] ?></small>
                        </h5>
                        <p><?= $value['comment'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="padding: .6em 0">Be the first one to comment!</div>
        <?php endif; ?>
    </div>

</div>
