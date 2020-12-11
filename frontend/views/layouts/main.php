<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                //['label' => 'Sobre', 'url' => ['/site/about']],
                //['label' => 'Contacto', 'url' => ['/site/contact']],

                ['label' => 'Usuarios',
                    'url' => ['/usuarios'],
                    'visible' => !Yii::$app->user->isGuest &&
                        (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4'||Yii::$app->user->identity->rol_id=='2')],
                ['label' => 'Proyectos',
                    'url' => ['/proyecto'],
                    'visible' => !Yii::$app->user->isGuest &&
                        (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4'||Yii::$app->user->identity->rol_id=='2')],
                ['label' => 'Analistas',
                    'url' => ['/analista'],
                    'visible' => !Yii::$app->user->isGuest &&
                        (Yii::$app->user->identity->rol_id=='2'||Yii::$app->user->identity->rol_id=='4')],
                ['label' => 'Usuarios Contraseña',
                    'url' => ['/user'],
                    'visible' => !Yii::$app->user->isGuest &&
                        (Yii::$app->user->identity->rol_id=='2')],


            ];
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Registro de Usuario', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
            }
                 else {
                     if (Yii::$app->user->identity->rol_id=='2') {
                         $menuItems[] = ['label' => 'Registro de Usuario', 'url' => ['/site/signup']];
                         $menuItems[] = [
                             'label' => 'Admin', 'items' => [
                                 ['label' => 'Rol', 'url' => ['/rol'], 'visible' => !Yii::$app->user->isGuest &&Yii::$app->user->identity->rol_id=='2'],
                                 ['label' => 'Operaciones', 'url' => ['/operacion'], 'visible' => !Yii::$app->user->isGuest &&Yii::$app->user->identity->rol_id=='2'],

                             ]
                         ];

                     }
                     $menuItems[] = [
                         'label' => 'Estadisticas', 'items' => [
                             ['label' => 'Estadisticas por Actividad',
                                 'url' => ['/reporte'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'|| Yii::$app->user->identity->rol_id=='4')],
                             /*['label' => 'Estadisticas por Horas',
                                 'url' => ['/reporte/reporte-horas'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'|| Yii::$app->user->identity->rol_id=='4')],*/
                             ['label' => 'Estadisticas por trabajador',
                                 'url' => ['/estadistica-analista'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'|| Yii::$app->user->identity->rol_id=='4')],
                             ['label' => 'Estadisticas por organización',
                                 'url' => ['/organizacion'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'|| Yii::$app->user->identity->rol_id=='4')],
                         ]
                     ];
                     $menuItems[] = [
                         'label' => 'Actividades', 'items' => [
                             ['label' => 'Actividades',
                                 'url' => ['/actividad'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4')],
                             ['label' => 'Actividades Resaltantes',
                                 'url' => ['/actividades-resaltantes'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4')],
                             ['label' => 'Actividades Sociopoliticas',
                                 'url' => ['/actividades-sociopoliticas'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4')],
                             ['label' => 'Actividades Complementarias',
                                 'url' => ['/actividades-complementarias'],
                                 'visible' => !Yii::$app->user->isGuest &&
                                     (Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4')],
                         ]
                     ];
                     $menuItems[] = [
                         'label' => 'Bienvenid@ '. Yii::$app->user->identity->nombre, 'items' => [
                             '<li role="presentation" class="divider"></li>',
                             ['label' => 'Opciones de Perfil'],
                             ['label' => 'Modificar Contraseña', 'url' => ['/site/reset-password'],'visible' => !Yii::$app->user->isGuest],
                             '<li role="presentation" class="divider"></li>',
                             ['label' => 'Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
                                 'url' => ['/site/logout'],
                                 'linkOptions' => ['data-method' => 'post']],
                         ]
                     ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Inicio',
                'url' => Yii::$app->homeUrl,
            ],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; PDVSA <?= date('Y') ?></p>
        <p class="pull-right">Powered by Noelí Ovando</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
