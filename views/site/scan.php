<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name; 

?>

<div class="site-index">
    <section class="section-content">
        <div class="content container">
            <div class="row">
                <div class="col-md-2 ">
                    <div class="widget-categories">
                        <h4 class="widget-title">Категории</h4>
                        <ul>
                            <?php foreach($genre as $genres) : ?>
                                <li>
                                    <p class= "text-uppercase">
                                        <a href="<? echo( Url:: to(['site/scan', 'tip' => "genre", 'id' => $genres->ID]))?>"><? echo( $genres->gname) ?></a>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- /widget-categories -->
                </div>

                <div class="col-md-8 container">
                  <h3 class="text-center">Книги</h3>
                  <br>
                  <?php foreach($scan as $scans) :?>
                    <article class="article-preview" >
                        <h3 class='text-center'>
                            <a href ="<? echo( Url:: to(['site/book', 'id' => $scans->ID]))?>">
                                <?= $scans->name; ?>
                            </a>
                        </h3>
                        <div class="article-excerpt row">
                            <div class="col-md-4 ">
                        <?= \yii\helpers\Html::img("@web/img/b{$scans->ID}.jpg") ?>
                            </div>
                            <div class="col-md-8 ">
                        <p>Автор: 
                            <a href="<? echo( Url:: to(['site/scan', 'tip' => "author", 'id' => $scans->ID_autor]))?>">
                                <?= $scans->author->Full_name ?>
                            </a>
                        </p>
                        <p>Жанр:
                            <a href="<? echo( Url:: to(['site/scan', 'tip' => "genre", 'id' => $scans->ID_genre]))?>">
                                <?= $scans->genre->gname ?>
                            </a>
                        </p>
                        <p><?= \yii\helpers\StringHelper::truncateWords(" {$scans->content}",35,'...'); ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
                </div>
                <div class="col-md-2">
                  <br>
                  <?php $form = ActiveForm::begin(); ?>

                    <?php echo $form->field($model, 'keyword'); ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.section-content -->

</div>
