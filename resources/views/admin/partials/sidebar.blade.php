<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{__('Блог')}} <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('Главная')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Heading -->
    <div class="sidebar-heading">
        Управление блогом
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-add-post-form')}}">
            <i class="fas fa-plus"></i>
            <span>Добавить пост</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-add-category-form')}}">
            <i class="fas fa-plus"></i>
            <span>Добавить категорию</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-comment-table')}}">
            <i class="fas fa-comments"></i>
            <span>Комментарии</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Heading -->
    <div class="sidebar-heading">
        Настройки
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogFeatures" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Поддержка</span>
        </a>
        <div id="collapseBlogFeatures" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Настройки:</h6>
                <a class="collapse-item" href="/admin/log-view">
                    <i class="fas fa-plus"></i>
                    <span>Просмотр логов</span></a>
                <a class="collapse-item" href="{{route('admin-db-backup')}}">
                    <i class="fas fa-plus"></i>
                    <span>Сгенирировать дамп</span></a>

            </div>
        </div>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->