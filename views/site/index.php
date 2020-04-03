<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\components\BootstrapLinkPager;

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

                <div class="col-md-10 container">
                    <?php foreach($site as $sites) : ?>
                        <article class="article-preview" >
                            <h3 class='text-center'>
                                <a href ="<? echo( Url:: to(['site/book', 'id' => $sites->ID]))?>">
                                    <?= $sites->name ?>
                                </a>
                            </h3>
                            <div class="article-excerpt row">
                                <div class="col-md-4 ">
                            <?= \yii\helpers\Html::img("@web/img/b{$sites->ID}.jpg") ?>
                                </div>
                                <div class="col-md-8 ">
                            <p>Автор: 
                                <a href="<? echo( Url:: to(['site/scan', 'tip' => "author", 'id' => $sites->ID_autor]))?>">
                                    <?= $sites->author->Full_name ?>
                                </a>
                            </p>
                            <p>Жанр:
                                <a href="<? echo( Url:: to(['site/scan', 'tip' => "genre", 'id' => $sites->ID_genre]))?>">
                                    <?= $sites->genre->gname ?>
                                </a>
                            </p>
                            <p><?= \yii\helpers\StringHelper::truncateWords(" $sites->content",35,'...'); ?></p>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

            </div>

            <?= BootstrapLinkPager::widget([
                'pagination' => $pages,
            ]); ?>
            
        </div>
    </section>
    <!-- /.section-content -->

</div>
