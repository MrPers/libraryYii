<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;


AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
  <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="float-left">>
							<a class="navbar-brand" href="/" >Bla Bla </a>
					</div>
		<div class="collapse navbar-collapse flё    oat-right" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="<? echo( Url:: to(['/admin/author']))?>">Автор</a></li>
				<li class="nav-item"><a class="nav-link" href="<? echo( Url:: to(['/admin/book']))?>">Книга</a></li>
				<li class="nav-item"><a class="nav-link" href="<? echo( Url:: to(['/admin/user']))?>">Пользователь</a></li>
				<li class="nav-item"><a class="nav-link" href="<? echo( Url:: to(['/admin/genre']))?>">Жанр</a></li>
				<div class="i_con">
							<ul class="nav navbar-nav text-uppercase">
									<?php if(Yii::$app->user->isGuest):?>
											<li><a class="nav-link" href="<?= Url::toRoute(['auth/login'])?>">Вход</a></li>
											<li><a class="nav-link" href="<?= Url::toRoute(['auth/signup'])?>">Регистрация</a></li>
									<?php else: ?>
											<?= Html::beginForm(['/auth/logout'], 'post')
											. Html::submitButton(
													Yii::$app->user->identity->name,
													['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
											)
											. Html::endForm() ?>
									<?php endif;?>
							</ul>
					</div>
			</ul>				
		</div>
	</nav>
</header>

	<?php
	NavBar::begin([]);
	NavBar::end();
	?>

	<div class="container">
			<?= Alert::widget() ?>
			<?= $content ?>
	</div>

	<div class="copyright fixed-bottom">
		<div class="container">
			<span class="nav-link">&copy; Bla BLa BLa</span>
		</div>
	</div>
	<!-- /.copyright -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
