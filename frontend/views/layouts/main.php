<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <link rel="stylesheet" href="https://js.arcgis.com/4.25/esri/themes/light/main.css">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <script src="https://js.arcgis.com/4.25/"></script>
    <script>
        require([
            "esri/config",
            "esri/Map",
            "esri/views/MapView",
            "esri/Graphic",
            "esri/layers/GraphicsLayer",
            "esri/layers/support/ImageElement",
            "esri/layers/MediaLayer",
            "esri/geometry/Extent",
            "esri/widgets/Expand",
            "esri/layers/support/ExtentAndRotationGeoreference",
        ], function (esriConfig, Map, MapView, Graphic, GraphicsLayer, ImageElement, MediaLayer, Extent, Expand, ExtentAndRotationGeoreference) {

            esriConfig.apiKey = "AAPK7c728bdfdd9b4974a626952b6f5f9ed4YR97rFrGndZjwxK8pl61NOjZP7Xy9UFiYpR-2Qr2zGyDbkSwKCpvX7MufwRCLYh4";

            const imageInfos = [
                {
                    name: "neworleans1891",
                    title: "New Orleans 1891",
                    extent: {
                        xmin: -10047456.27662979,
                        ymin: 3486722.2723874687,
                        xmax: -10006982.870152846,
                        ymax: 3514468.91365495
                    }
                }
            ];

            function createImageElement(name, box) {
                const imageElement = new ImageElement({
                    image: `http://argis-api/img/c2019.tif`,
                    georeference: new ExtentAndRotationGeoreference({
                        extent: new Extent({
                            spatialReference: {
                                wkid: 102100
                            },
                            xmin: box.xmin,
                            ymin: box.ymin,
                            xmax: box.xmax,
                            ymax: box.ymax
                        })
                    })
                });
                return imageElement;
            }

            let imageElements = [];

            imageInfos.forEach((image, i) => {
                const elementDiv = document.createElement("div");
                elementDiv.classList.add("elementDiv");

                const imageElement = {
                    name: image.name,
                    title: image.title,
                    element: createImageElement(image.name, image.extent)
                };
                imageElements.push(imageElement);
            });

            const layer = new MediaLayer({
                source: [
                    imageElements[0].element,
                ],
                opacity: 0.9,
                title: "New Orleans",
                blendMode: "normal"
            });

            const map = new Map({
                basemap: "arcgis-topographic",
                layers: [layer]
            });

            const view = new MapView({
                map: map,
                center: [28.67307, 50.2639208],
                zoom: 13,
                container: "viewDiv",
                popup: {
                    dockEnabled: true,
                    dockOptions: {
                        breakpoint: false,
                        position: "top-right"
                    }
                },
            });

            const graphicsLayer = new GraphicsLayer();
            map.add(graphicsLayer);

            $.ajax({
                type: "POST",
                url: 'site/data',
                success: function (data) {
                    $.each(data, function (i, item) {
                        const polygon = {
                            type: "polygon",
                            rings: [
                                [item.top_left_point_x, item.top_left_point_y], //Longitude, latitude
                                [item.top_right_point_x, item.top_right_point_y], //Longitude, latitude
                                [item.bottom_left_point_x, item.bottom_left_point_y], //Longitude, latitude
                                [item.bottom_right_point_x, item.bottom_right_point_y],   //Longitude, latitude
                            ],
                        };

                        let color;

                        if (item.description.year_2021 <= 15) {
                            color = [75, 245, 66];
                        } else if (item.description.year_2021 > 15 && item.description.year_2021 <=30) {
                            color = [226, 119, 40];
                        } else if (item.description.year_2021 > 30) {
                            color = [245, 66, 66];
                        }

                        const simpleMarkerSymbol = {
                            type: "simple-fill",
                            color: color,  // Orange
                            outline: {
                                color: [255, 255, 255], // White
                                width: 1
                            }
                        };

                        var attributes = {};

                        attributes['2019'] = item.description.year_2019;
                        attributes['2020'] = item.description.year_2020;
                        attributes['2021'] = item.description.year_2021;

                        console.log(attributes);
                        const popupTemplate = {
                            title: "Середня температура за рік",
                            content: [{
                                type: "media",
                                mediaInfos: [{
                                    type: "column-chart",
                                    value: {
                                        fields: ["2019", "2020", "2021"]
                                    }
                                }]
                            }]
                        };

                        const polygonGraphic = new Graphic({
                            geometry: polygon,
                            symbol: simpleMarkerSymbol,
                            attributes: attributes,
                            popupTemplate: popupTemplate
                        });
                        graphicsLayer.add(polygonGraphic);
                    })
                },
            })
        });
    </script>
    </body>
    </html>
<?php $this->endPage();
