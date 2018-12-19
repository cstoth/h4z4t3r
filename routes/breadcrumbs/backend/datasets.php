<?php

// CITY (Frontend)

Breadcrumbs::for('frontend.datasets.city.index', function ($trail) {
    $trail->parent('frontend.dashboard');
    $trail->push(__('menus.backend.access.cities.management'), route('frontend.datasets.city.index'));
});

// CITY (ADMIN)

Breadcrumbs::for('admin.datasets.city.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.access.cities.management'), route('admin.datasets.city.index'));
});

Breadcrumbs::for('admin.datasets.city.create', function ($trail) {
    $trail->parent('admin.datasets.city.index');
    $trail->push(__('menus.backend.access.cities.create'), route('admin.datasets.city.create'));
});

Breadcrumbs::for('admin.datasets.city.show', function ($trail, $id) {
    $trail->parent('admin.datasets.city.index');
    $trail->push(__('menus.backend.access.cities.show'), route('admin.datasets.city.show', $id));
});

Breadcrumbs::for('admin.datasets.city.edit', function ($trail, $id) {
    $trail->parent('admin.datasets.city.index');
    $trail->push(__('menus.backend.access.cities.edit'), route('admin.datasets.city.edit', $id));
});

// CAR

Breadcrumbs::for('admin.datasets.car.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.datasets.car.management'), route('admin.datasets.car.index'));
});

Breadcrumbs::for('admin.datasets.car.create', function ($trail) {
    $trail->parent('admin.datasets.car.index');
    $trail->push(__('menus.backend.datasets.car.create'), route('admin.datasets.car.create'));
});

Breadcrumbs::for('admin.datasets.car.show', function ($trail, $id) {
    $trail->parent('admin.datasets.car.index');
    $trail->push(__('menus.backend.datasets.car.show'), route('admin.datasets.car.show', $id));
});

Breadcrumbs::for('admin.datasets.car.edit', function ($trail, $id) {
    $trail->parent('admin.datasets.car.index');
    $trail->push(__('menus.backend.datasets.car.edit'), route('admin.datasets.car.edit', $id));
});


