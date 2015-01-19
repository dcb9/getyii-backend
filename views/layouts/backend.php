<?php
use backend\assets\AppAsset;
use backend\assets\BackendAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div id="wrapper">

        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => [
                    'class' => ''
                ],
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top ',
                ],
            ]);

             echo Nav::widget([
                 'options' => ['class' => 'navbar-nav navbar-right', 'id' => 'navbar-main'],
                 'items' => [
                     ['label' => 'Home', 'url' => ['/site/index']],
                     ['label' => 'About', 'url' => ['/site/about']],
                     ['label' => 'Contact', 'url' => ['/site/contact']],
                     [
                         'label' => 'Products', 'url' => ['product/index'],
                         'items' => [
                             ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                             ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
                     ]],
                     Yii::$app->user->isGuest ?
                         ['label' => 'Login', 'url' => ['/site/login']] :
                         ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                             'url' => ['/site/logout'],
                             'linkOptions' => ['data-method' => 'post']],
                 ],
             ]);

        ?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php echo Menu::widget([
                        'options'=>['class'=>'nav', 'id'=>'side-menu'],
                        'submenuTemplate' => "\n<ul class='nav nav-second-level collapse'>\n{items}\n</ul>\n",
                        'items' => [
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            ['label' => 'Home', 'url' => ['site/index']],
                            // 'Products' menu item will be selected as long as the route is 'product/index'
                            [
                                'label' => 'Products', 'url' => ['product/index'],
                                'items' => [
                                ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                                ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
                            ]],
                            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ],
                    ]); ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

        <?php NavBar::end(); ?>
        <div id="page-wrapper">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

