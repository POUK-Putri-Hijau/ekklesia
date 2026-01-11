<?php
function isActiveRoute($routeName) {
    return request()->routeIs($routeName) ? 'dock-active' : '';
}
