<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use kartik\widgets\StarRating;

$this->title = Yii::$app->name;

// ->author->Full_name
?>

<section class="section-content">
    <div class="content container">
        <div class="row">
            <div class="col-md-2 widget-categories">
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
            <div class="col-md-10 order-md-first">
                <h3 class = "text-center"><?= $book->name ?></h3>
                <br>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="view-book">
                            <?= \yii\helpers\Html::img("@web/img/b{$book->ID}.jpg") ?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <h5>Автор: <?= $book->author->Full_name ?></h5>
                        <h5>Жанр: <?= $book->genre->gname ?></h5>
                        <p>
                        <fieldset class="rating" >
                            <div class="rating__group">
                                <a href="user">
                                    <input class="rating__star" type="radio" name="health" value="1" aria-label="Ужасно" checked >
                                    <input class="rating__star" type="radio" name="health" value="2" aria-label="Сносно">
                                    <input class="rating__star" type="radio" name="health" value="3" aria-label="Нормально">
                                    <input class="rating__star" type="radio" name="health" value="4" aria-label="Хорошо">
                                    <input class="rating__star" type="radio" name="health" value="5" aria-label="Отлично">
                                </a>
                                <div class="rating__focus"></div>
                            </div>
                        </fieldset>
                        Рейтинг: <?php echo round($book->getRating()[0], 1);?>
                    </div>
                </div>
                <br>
                <h5 class="text-center">Описание: </h5>
                <p><?= $book->content?></p>
            </div>
        </div>
    </div>
</section>
<!-- /.section-content -->