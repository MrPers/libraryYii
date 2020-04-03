<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;

use yii\helpers\Html;
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
			<a class="navbar-brand" href="/" >Bla Bla </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="<? echo( Url:: to(['/scan']))?>">Поиск</a></li>
					<?php if(Yii::$app->user->identity->ISADMIN):?>
							<li><a class="nav-link" href="<?= Url::toRoute(['/admin'])?>">Админка</a></li>
					<?php endif;?>
					<div class="i_con">
							<ul class="nav navbar-nav text-uppercase">
									<?php if(Yii::$app->user->isGuest):?>
											<li><a class="nav-link" href="<?= Url::toRoute(['auth/login'])?>">Вход</a></li>
											<li><a class="nav-link" href="<?= Url::toRoute(['auth/signup'])?>">Регистрация</a></li>
									<?php else: ?>
											<li><?= Html::beginForm(['/auth/logout'], 'post')
											. Html::submitButton(
													Yii::$app->user->identity->name,
													['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
											)
											. Html::endForm() ?>
											</li>
									<?php endif;?>
							</ul>
					</div>
				</ul>				
			</div>
		</nav>
	</header>
	<!-- /.header -->
	
	<div class="content">

  	<?= $content ?>
	
	</div>

	<div class="copyright">
		<div class="container">
			<span class="nav-link">&copy; Bla BLa BLa</span>
		</div>
	</div>
	<!-- /.copyright -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
