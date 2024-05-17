<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
</script>

<template>
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="#">
                <Link :href="route('dashboard')">
                <ApplicationLogo style="width: 40px; color: #FFF !important;" />
                <span class="align-middle text-white"
                    style="margin-left: 14px; font-size: 24px; text-transform: uppercase;">{{ appName }}</span>
                </Link>
            </a>

            <ul class="sidebar-nav">
                <!-- <li class="sidebar-header">Pages</li> -->

                <li class="sidebar-item" :class="{ 'active': route().current('welcome') }">
                    <Link :href="route('welcome')" class="sidebar-link">
                    <i class="fas fa-tachometer-alt align-middle"></i>
                    <span class="align-middle">Dashboard</span>
                    </Link>
                </li>

                <!-- <li class="sidebar-item">
                    <a data-bs-target="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="fas fa-bars align-middle"></i>
                        <span class="align-middle">Menu Example</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#">Menu Example</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#">Menu Example</a>
                        </li>
                    </ul>
                </li> -->

                <li class="sidebar-item" :class="{ 'active': route().current('blogs.index') }">
                    <Link :href="route('blogs.index')" class="sidebar-link">
                    <i class="fas fa-bars align-middle"></i>
                    <span class="align-middle">Blog</span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>
