<header>
  <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0;">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?= $this->Html->link('TIG3B', '/', array('class'=>'navbar-brand')) ?>
      </div>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav">
          <li><?= $this->Html->link('Artigos', array('controller'=>'articles', 'action'=>'index')) ?></li>
          <li><?= $this->Html->link('Discover', array('controller'=>'articles', 'action'=>'discover')) ?></li>
        </ul>

        <!-- <form class="navbar-form navbar-left" role="search" action="/search/">
          <div class="input-group" style="width:210px">
            <input type="text" class="form-control" name="q" placeholder="Search" autocomplete="off">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div>
        </form> -->

        <ul class="nav navbar-nav navbar-right">
          <li>
            <?= $this->Html->link($this->Session->read('Auth.User.name'), array('controller'=>'users', 'action'=>'view', $this->Session->read('Auth.User.id'))) ?>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><?= $this->Html->link('Conta', array('controller'=>'users', 'action'=>'edit')) ?></li>
              <li class="divider"></li>
              <li><?= $this->Html->link('Log out', array('controller'=>'users', 'action'=>'logout')) ?></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
